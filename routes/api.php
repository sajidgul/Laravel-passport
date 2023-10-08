<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware('auth:api')->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });

    // Authors Route
    Route::get('/authors/{author}', [AuthorController::class, 'show']);
    Route::get('/authors', [AuthorController::class, 'index']);
    Route::post('/authors/store', [AuthorController::class, 'store']);
    Route::put('/authors/{author}', [AuthorController::class, 'update']);
    Route::delete('/authors/{author}', [AuthorController::class, 'destroy']);
    Route::post('/logout', [AuthController::class, 'logout']);

    // Books Route
    Route::get('/books', [BooksController::class, 'index']);
    Route::post('/books/store', [BooksController::class, 'store']);
    Route::get('/books/{book}', [BooksController::class, 'show']);
    Route::put('/books/{book}', [BooksController::class, 'update']);
    Route::delete('/books/{book}', [BooksController::class, 'destroy']);
});