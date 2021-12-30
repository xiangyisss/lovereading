<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
// use App\Http\Controllers\ReviewController;



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



Route::get('/', [ BookController::class, 'index']);
Route::get('/books', [ BookController::class, 'getBooks']);

// Route::get('/about', [ BookController::class, 'index']);
Route::get('/login_form', [ LoginController::class, 'index']);
Route::get('/register_form', [ RegisterController::class, 'index']);
Route::get('/auth_user', [UserController::class, 'index']);




Route::get('/token', function(){
    return [
        'token' => csrf_token()
    ];
});

Auth::routes();