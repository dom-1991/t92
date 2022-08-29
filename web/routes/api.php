<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/check-token-valid', [AuthController::class, 'checkTokenValid'])->name('checkTokenValid');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('userProfile');
    Route::post('/change-pass', [AuthController::class, 'changePassWord'])->name('changePassWord');  
    Route::post('/change-pass-from-email-link', [AuthController::class, 'changePassWordFromEmailLink'])->name('changePassWordFromEmailLink');
    Route::post('/{provider}/user-from-token', [AuthController::class, 'userFromTokenApi'])
    ->name('social.userFromTokenApi');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'

], function ($router) {
    Route::apiResource('users', App\Http\Controllers\AdminController::class); 
    Route::post('/email', [App\Http\Controllers\MailController::class, 'sendEmail'])->name('send-email');
    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload'])->name('multi-upload-images');    
    Route::apiResource('/roles', App\Http\Controllers\Roles\RoleController::class);
    Route::apiResource('/routes', App\Http\Controllers\Routes\RoutesController::class);
    Route::apiResource('/role-route', App\Http\Controllers\Roles\RoleRouteController::class);
});
