<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\BookCollection;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return new BookCollection(Book::paginate(10));
    }
    public function show(Book $book)
    {
        return response()->json(new BookResource($book), 200);
    }
    public function store(Request $request)
    {
        $book = Book::create($request->all());
        return response()->json($book,201);
    }
    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return response()->json($book,200);
    }
    public function delete(Request $request, Book $book)
    {
        $book->delete();
        return response()->json(null,204);
    }
}
