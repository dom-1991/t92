<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Socialite;
use Laravel\Socialite\Facades\Socialite as Social;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\UserResource;
use App\Message\Message;
use DB;
use Illuminate\Support\Facades\Password;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {        
        $this->middleware('auth:api', ['except' => ['login', 'register', 'userFromTokenApi', 'redirectToProvider', 'handleProviderCallback', 'forgotPassword', 'changePassword', 'changePassWordFromEmailLink']]);
    }

    /**
     * Request user info from provider token
     *
     * @return Response
     */
    
    public function forgotPassword(Request $request){
        $input = $request->all();        
        $rules = array(
            'email' => "required|email",
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            $arr = array("status" => 400, "message" => $validator->errors()->first(), "data" => array());
        } else {
            try {
                event(new \App\Events\ForgotPassWordEvent($request->only('email')));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return 'Sending .. ok';
    }

    public function userFromTokenApi($provider){
        $user = Social::driver($provider)->userFromToken(Request()->token);
        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        // $user->getAvatar();

        $authUser = $this->findOrCreateUser($user, $provider);
        if (! $token = Auth::login($authUser, true)) {
            return response()->json([
                'email' => [Message::EMAIL_NOT_FOUND]
            ], 422);
        }

        return $this->createNewToken($token);
    }


    /**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();
        // OAuth Two Providers
        $token = $user->token;
        $refreshToken = $user->refreshToken; // not always provided
        $expiresIn = $user->expiresIn;

        // All Providers
        $user->getId();
        $user->getNickname();
        $user->getName();
        $user->getEmail();
        $user->getAvatar();
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);
        return response()->json($user);
        
    }

    public function findOrCreateUser($user, $provider){
        $authUser = User::where('provider_id', $user->id)->first();
        if($authUser){
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'email' => $user->email,
            'provider' => strtoupper($provider),
            'provider_id' => $user->id,
            'avatar' => $user->avatar,
        ]);
    }



    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        if (! $token = auth()->attempt($validator->validated())) {
            return response()->json([
                'email' => [Message::EMAIL_NOT_FOUND]
            ], 422);
        }

        return $this->createNewToken($token);
    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));

        return response()->json([
            'message' => Message::REGISTER_SUCCESS,
            'user' => $user
        ], 201);
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => Message::LOGOUT_SUCCESS]);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        $permissions = User::getPermission();
        $permission_name_frontend = [];
        $permission_role_name = [];
        foreach($permissions['permission'] as $permission){
            $permission_role_name[] = $permission->name;
            $permission_name_frontend[] = $permission->name_frontend;            
        }
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $permissions['user'],
            'role' => array_unique($permission_role_name),
            'permission' => $permission_name_frontend,
        ]);
    }

    public function changePassWord(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|confirmed|min:6',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $userId = auth()->user()->id;

        $user = User::where('id', $userId)->update(
            ['password' => bcrypt($request->new_password)]
        );
        return response()->json([
            'message' => Message::PASSWORD_CHANGE_SUCCESS,
            'user' => $user,
        ], 201);
    }

    public function changePassWordFromEmailLink(Request $request) {
        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|confirmed|min:6',
            'token' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        // dd(DB::table('password_resets')->get());
        $result = DB::table('password_resets')->where('token', $request->token);

        if(count($result->get()) == 1){
            if((strtotime($result->get()[0]->created_at) + env('LIMIT_TIME_CHANGE_PASS')) > time()){
                $user = User::where('email', $request->email)->update(
                    ['password' => bcrypt($request->new_password)]
                );
                $result->delete();
                return [
                    'error' => 0,
                    'message' => \App\Message\Message::PASSWORD_CHANGE_SUCCESS
                ];
            }else{
                return [
                    'error' => 1,
                    'message' => \App\Message\Message::FORGOT_PASSWORD_5P
                ];                
                
            }
        }else{
            return [
                'error' => 1,
                'message' => \App\Message\Message::TOKEN_NOT_FOUND
            ];
        }
    }
}
