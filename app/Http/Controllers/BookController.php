<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Http\Resources\Book as BookResource;
use App\Http\Resources\BookCollection;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
    ];

    public static $rules = [
        'title' => 'required|string',
        'author' => 'required|string',
        'editorial' => 'required|string',
        'year_edition' => 'required|numeric',
        'price' => 'required|numeric',
        'pages' => 'required|numeric',
        'synopsis' => 'required|string|max:255',
        'cover_page' => '',
        'back_cover' => '',
        'available' => 'required|boolean',
        'new' => 'required|boolean'
    ];

    public function index()
    {
       //$this->authorize('ViewAny',Book::class);

        return new BookCollection(Book::paginate(10));
    }

    public function show(Book $book)
    {
        //$this->authorize('View',Book::class);

        return response()->json(new BookResource($book), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, User $user)
    {
        //$this->authorize('create',$book);

        $request->validate(self::$rules, self::$messages);
//        $book = Book::create($request->all());
//        return response()->json($book,201);

        $book = $user->books()->save(new Book($request->all()));
        return response()->json($book, 201);
    }

    public function update(Request $request, Book $book)
    {
        $this->authorize('update',$book);

        $request->validate(self::$rules, self::$messages);
        $book->update($request->all());
        return response()->json($book, 200);
    }

    public function delete(Book $book)
    {
        $this->authorize('delete',$book);

        $book->delete();
        return response()->json(null, 204);
    }

    /**
     * Display a listing of the resource.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function showmybooks(User $user)
    {
        return response()->json(BookResource::collection($user->books), 200);
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function showmybook(User $user, Book $book)
    {
        $book = $user->books()->where('id', $book->id)->firstOrFail();
        return response()->json($book, 200);
    }
}
