<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;


use App\Http\Controllers\BookController;
use App\Http\Controllers\StoreController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

Route::group([
        'middleware'=>['auth:sanctum']
], function (){

    Route::get('/books', [BookController::class, 'index']); // Listar todos os livros
    Route::post('/books', [BookController::class, 'store']); // Criar um novo livro
    Route::get('/books/{book}', [BookController::class, 'show']); // Exibir um livro específico
    Route::put('/books/{book}', [BookController::class, 'update']); // Atualizar um livro
    Route::delete('/books/{book}', [BookController::class, 'destroy']); // Excluir um livro

});

