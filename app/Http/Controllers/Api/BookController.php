<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json(['data' => $books],200);
    }
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json(['message'=>"Book created successfully",'data' => $book],201); 
    }
    public function show(string $book)
    {
        $book = Book::find($book);
        if($book){
            return response()->json(['data' => $book],200); 
            
        }
        return response()->json(['message' => "Book not found"],404);
    }
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return response()->json(['message'=>"Book updated successfully",'data' => $book],200); 
    }
    public function destroy(string $book)
    {
        $book = Book::find($book);
        if($book){  
            $book->delete();
            return response()->json(['message' => "Book deleted successfully"],200);

        }
        return response()->json(['message' => "Book not deleted successfully"],404);
    }
}
