<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\SaveBookRequest;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Books/BookIndex');
    }

    public function addNewBook() 
    {
        return Inertia::render('Books/CreateBook');
    }

    public function __construct (Book $book)
    {
        $this->book = $book;
    }
    
    public function getBooks()
    {
        return $this->book->get();
    }

    public function storeBook(SaveBookRequest $request)
    {   

        $validData = $request->validated();
        $this->book->create($validData);
        $path = $request->file('image')->store('images');
        return $path;
    }
}
