<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// khai báo sử dụng loginRequest
use App\Http\Requests\LoginRequest;
use Auth;
use App\User;

class LoginController extends Controller
{
    public function getLogin(){

        if (Auth::check()) {
            // nếu đăng nhập thàng công thì 
        } else {
            return view('pages.login.login');
        }

    }
    public function postLogin(LoginRequest $request){

        App\Models\User::create([

            'email' => 'hopnv@vmodev.com',
            'password' => Hash::make('123456');

        ]);


        $login = [
            'email' => $request->txtEmail,
            'password' => $request->txtPassword,
            'level' => 1,
            'status' => 1
        ];
        if (Auth::attempt($login)) {

        } else {
            return redirect()->back()->with('status', 'Email hoặc Password không chính xác');
        }
    }

    public function getLogout(){

    }
}
