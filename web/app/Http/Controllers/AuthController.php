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
use App\Http\Requests\AdminRequest;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    
    const PASSWORD_RESETS_TABLE = 'password_resets';

    public function __construct() {        
        $this->middleware('auth:api', ['except' => ['login', 'register', 'userFromTokenApi', 'redirectToProvider', 'handleProviderCallback', 'forgotPassword', 'changePassword', 'changePassWordFromEmailLink', 'checkTokenValid']]);
    }

    public function validateReset(array $credentials)
    {
        if (is_null($user = Password::broker()->getUser($credentials))) {
            return response()->json([
                'error' => 1,
                'message' => Message::USER_RESET_INVALID
            ], Message::ERROR_CODE_400);
        }

        if (! Password::broker()->tokenExists($user, $credentials['token'])) {
            return response()->json([
                'error' => 1,
                'message' => Message::TOKEN_RESET_INVALID
            ], Message::ERROR_CODE_400);
        }

        return response()->json([
            'error' => 0,
            'message' => Message::TOKEN_VALID
        ], Message::ERROR_CODE_200);
    }

    
    public function checkTokenValid(Request $request){

        $tokenEncode = $this->validateReset(['email' => $request->email, 'token' => $request->token]);
        $tokenDecode = json_decode(json_encode($tokenEncode));
        if($tokenDecode->original->error == 0){
            $result = DB::table(self::PASSWORD_RESETS_TABLE)->where('email', $request->email);
            if(count($result->get()) == 1){
                if((strtotime($result->get()[0]->created_at) + env('LIMIT_TIME_CHANGE_PASS')) > time()){
                    $data['error'] = Message::ERROR_CODE_SUCCESS;
                    $data['message'] = Message::TOKEN_VALID;
                    $data['token'] = $result->get()[0]->token;
                    $data['email'] = $result->get()[0]->email;
                    return response()->json($data, Message::ERROR_CODE_200);
                }else{
                    $data['error'] = 1;
                    $data['message'] = Message::FORGOT_PASSWORD_5P;
                    $data['token'] = $request->token;
                    $data['email'] = null;
                    return response()->json($data, Message::ERROR_CODE_400);
                }
            }else{
                $data['error'] = Message::ERROR_CODE_404;
                $data['message'] = Message::TOKEN_NOT_FOUND;
                $data['token'] = $request->token;
                $data['email'] = null;
                return response()->json($data, Message::ERROR_CODE_404);
            }
        }
        return response()->json([
            'error' => 1,
            'message' => $tokenDecode->original->message
        ], Message::ERROR_CODE_400);
    }

    public function forgotPassword(Request $request){
        $input = $request->all();        
        $rules = array(
            'email' => 'required|string|email|max:100',
        );
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json([
                'error' => Message::ERROR_CODE_400,
                'message' => $validator->errors()->first()
            ], Message::ERROR_CODE_400);
        } else {
            try {                
                event(new \App\Events\ForgotPassWordEvent($request->only('email')));
            } catch (\Exception $e) {
                return $e->getMessage();
            }
        }
        return response()->json([
            'error' => Message::ERROR_CODE_SUCCESS,
            'message' => Message::SENDING_MAIL_SUCCESS
        ]);
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
    public function register(AdminRequest $request) {
        $user = User::create(array_merge(
            $request->validated(),
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
        ], Message::ERROR_CODE_201);
    }

    public function changePassWordFromEmailLink(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'new_password' => 'required|string|confirmed|min:6',
            'token' => 'required|string'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $tokenEncode = $this->checkTokenValid($request);
        $tokenDecode = json_decode(json_encode($tokenEncode));
        if($tokenDecode->original->error == 0){
            $user = User::where('email', $request->email)->update(
                ['password' => bcrypt($request->new_password)]
            );
            try {
                DB::table(self::PASSWORD_RESETS_TABLE)->where('email', $request->email)->delete();
            } catch (Exception $e) {
                return $e->getMessage();
            }
            
            return response()->json([
                'error' => 0,
                'message' => \App\Message\Message::PASSWORD_CHANGE_SUCCESS
            ], Message::ERROR_CODE_200);
        }else{
            return response()->json([
                'error' => Message::ERROR_CODE_FAIL,
                'message' => $tokenDecode->original->message
            ], Message::ERROR_CODE_400);
        }
    }
}
