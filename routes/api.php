<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;

/*Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

Route::post('/register', [ApiController::class, 'register']);
Route::post('/login', [ApiController::class, 'login']);

/*Route::group([
        'middleware'=>['auth:sanctum']
], function (){
    Route::post('/books', BookController::class);
});*/

