<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'index'])->name('homepage');

Route::group(['as' => 'posts.', 'prefix' => 'posts'], function () {
    Route::get('create', function () {
        return view('posts.create');
    })->name('create');
    Route::post('', [PostController::class, 'store'])->name('store');
    Route::post('{id}/reaction', [PostController::class, 'reaction'])->name('reaction');
    Route::post('{id}/comment', [PostController::class, 'comment'])->name('comment');
    Route::get('{id}', [PostController::class, 'show'])->name('show');
});
