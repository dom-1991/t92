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

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->name('refresh');
    Route::get('/user-profile', [AuthController::class, 'userProfile'])->name('userProfile');
    Route::post('/change-pass', [AuthController::class, 'changePassWord'])->name('changePassWord');  
    Route::post('/{provider}/user-from-token', [AuthController::class, 'userFromTokenApi'])
    ->name('social.userFromToken');
    
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'admin'

], function ($router) {
    Route::get('/admin-list', [App\Http\Controllers\AdminController::class, 'getListAmin'])->name('admin-list'); 
    Route::post('/email', [App\Http\Controllers\MailController::class, 'sendEmail'])->name('send-email');
    Route::post('/upload', [App\Http\Controllers\UploadController::class, 'upload'])->name('multi-upload-images');
    Route::apiResource('/roles', App\Http\Controllers\RoleController::class);
});
