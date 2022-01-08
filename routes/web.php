<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;

Route::get('/login_form', [LoginController::class, 'index']);
Route::get('/register_form', [RegisterController::class, 'index']);
Route::get('/auth_user', [UserController::class, 'index']);

// Route::prefix('book')->group(function(){
//     Route::get('/', [BookController::class, 'index']);
//     Route::get('/{id}', [BookController::class, 'detailPage']);
//     Route::put('/{id}', [BookController::class, 'updateBook']);
//     Route::delete('/{id}', [BookController::class, 'deleteBook']);
// });

Route::get('/', [BookController::class, 'index'])->name('main-page');
Route::get('/add_new_book', [BookController::class, 'addNewBook']);
Route::get('/update_book/{book}', [BookController::class, 'edit']);

Route::get('/books/{id}', [BookController::class, 'detailPage']);
Route::post('/save_book', [BookController::class, 'create']);
Route::put('/books/{book}', [BookController::class, 'update']);
Route::delete('/books/{book}', [BookController::class, 'destroy']);
// Route::get('/about', [ BookController::class, 'index']);


Route::get('/token', function(){
    return [
        'token' => csrf_token()
    ];
});

Auth::routes();