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

    }
    public function postLogin(LoginRequest $request){

    }

    public function getLogout(){

    }
}
