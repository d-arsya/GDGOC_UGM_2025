<?php

use App\Http\Controllers\Api\BookController;
use Database\Factories\BookFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/', function (Request $request) {
    return response()->json("Test");
});
Route::fallback(function () {
    return response()->json(['message' => "Book not found"]);
});
Route::controller(BookController::class)->group(function(){
    Route::post('/books/bulk','storeBulk');
    Route::delete('/books/bulk','destroyBulk');
    Route::put('/books/bulk','updateBulk');
    Route::get('/books/bulk','showBulk');
});
Route::get('/reset', [BookController::class,'getToken']);
Route::post('/reset', [BookController::class,'resetDatabase']);
Route::get('books/generate',[BookController::class,'generate']);
Route::apiResource('books',BookController::class);
