<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RegisterController;


Route::get('/login_form', [LoginController::class, 'index']);
Route::get('/register_form', [RegisterController::class, 'index']);
Route::get('/auth_user', [UserController::class, 'index']);

Route::get('/', [BookController::class, 'index']);
Route::prefix('books')->group(function() {
    Route::get('/add_new_book', [BookController::class, 'addNewBook']);
    Route::get('/{id}', [BookController::class, 'detailPage']);
    Route::get('/edit/{book}', [BookController::class, 'edit']);
    Route::post('/save_book', [BookController::class, 'create']);
    Route::put('/{book}', [BookController::class, 'update']);
    Route::delete('/{book}', [BookController::class, 'destroy']);

    Route::prefix('reviews')->middleware('auth')->group(function() {
        Route::post('/', [ReviewController::class, 'create']);
        Route::get('/edit/{review}', [ReviewController::class, 'edit']);
        Route::put('/{review}', [ReviewController::class, 'update']);
        Route::delete('{review}', [ReviewController::class, 'destroy']);
    });
});

Auth::routes();
// Route::get('/token', function(){
//     return [
//         'token' => csrf_token()
//     ];
// });
