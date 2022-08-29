<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Route;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $users = User::getPermission();
        $routeName = Route::current()->getName();
        foreach($users['permission'] as $user){
            if($routeName == $user->name_backend){
                return $next($request);
            }
        }                
        return response()->json(['message' => \App\Message\Message::NO_PERMISSION]);
    }
}
