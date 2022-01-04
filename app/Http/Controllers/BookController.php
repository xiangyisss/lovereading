<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\SaveBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Auth;

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

    public function detailPage($bookId) 
    {
        $book = Book::find($bookId);
        return Inertia::render('Books/BookDetail', compact('book'));

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
        $path = $request->file('image')->store('uploads', 'public');
        $user_id = Auth::user()->id;
        $updateData = array_merge($validData, [            
            'user_id' => Auth::user()->id,
            'image' => $path, 
        ]);
        $this->book->create($updateData);

        return $updateData;
    }

    public function updateBook ($bookId, updateBookRequest $request)
    {
        $validData = $request->validated();
        $this->book->find($bookId)->update($validData);
    }

    public function deleteBook ($bookId)
    {
        $this->book->find($bookId)->delete();
    }

}
