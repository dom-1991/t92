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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => 'maintain'], function () {
    Route::get('duc-son', [\App\Http\Controllers\DateController::class, 'index'])->name('date.index');
    Route::post('duc-son', [\App\Http\Controllers\DateController::class, 'store'])->name('date.store');
});

Route::post('/', [\App\Http\Controllers\HomeController::class, 'maintain'])->name('maintain');
