<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Gate;
use App\Http\Requests\SaveBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Auth\Access\AuthorizationException;


class BookController extends Controller
{
    public function __construct (Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $books = $this->book->get();
        return Inertia::render('Books/BookIndex/BookIndex', compact('books'));
    }

    public function addNewBook() 
    {
        return Inertia::render('Books/Form/CreateOrUpdateInfo.vue');
    }

    // public function edit($bookId)
    public function edit(Book $book)
    {
        // $book = $this->book->find($bookId);
        return Inertia::render('Books/Form/CreateOrUpdateInfo.vue', compact('book'));
    }


    public function detailPage($bookId) 
    {
        $book = Book::find($bookId);
        return Inertia::render('Books/BookDetail/BookDetail', compact('book'));
    }

    public function create(SaveBookRequest $request)
    {   

        $validData = $request->validated();
        $path = $request->file('image')->store('uploads', 'public');
        $updateData = array_merge($validData, [            
            'user_id' => Auth::user()->id,
            'image' => $path, 
        ]);
        $this->book->create($updateData);
        return $updateData;
    }

    public function update(Book $book, updateBookRequest $request)
    {   
        $validData = $request->validated();
        $this->authorize('update', $book);
        $book->update($validData);
    }

    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
        $book->delete();
    }

}
