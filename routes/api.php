<?php

use App\Http\Controllers\Api\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    return response()->json("Test");
});
Route::fallback(function () {
    return response()->json(['message' => "Book not found"]);
});
Route::get('books/generate',[BookController::class,'generate']);
Route::apiResource('books',BookController::class);
