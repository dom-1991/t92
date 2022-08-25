<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/general', function(){
	return view('pages.forms.general');
});
Route::get('/advanced', function(){
	return view('pages.forms.advanced');
});
Route::get('/home', [App\Http\Controllers\PostController::class, 'home']);
Route::get('/chart', function(){
	return view('pages.charts.chart');
});
Route::get('/', [App\Http\Controllers\PostController::class, 'welcome']);
Route::get('/category', [App\Http\Controllers\CategoryController::class, 'index']);

Route::get('admincp/login', [App\Http\Controllers\LoginController::class, 'getLogin']);
Route::post('admincp/login', [App\Http\Controllers\LoginController::class, 'postLogin'])->name('postLogin');
Route::get('admincp/logout', [App\Http\Controllers\LoginController::class, 'getLogout']);

Route::group(['middleware' => 'checkAdminLogin', 'prefix' => 'admincp', 'namespace' => 'Admin'], function() {
	Route::get('/', function() {
		return view('admin.home');
	});
});
