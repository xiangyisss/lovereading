<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Inertia::render('Books/BookIndex');
    }

    public function __construct ( Book $book)
    {
        $this->book = $book;
    }

    public function getBooks()
    {
        return $this->book->get();
    }
}
