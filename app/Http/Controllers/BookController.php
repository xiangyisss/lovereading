<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Requests\SaveBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Support\Facades\Redirect;
use Auth;

class BookController extends Controller
{
    public function __construct (Book $book)
    {
        $this->book = $book;
    }

    public function index()
    {
        $books = $this->book->get();
        return Inertia::render('Books/MainBookFolder/BookIndex', compact('books'));
    }

    public function addNewBook() 
    {
        return Inertia::render('Books/Form/CreateOrUpdateInfo.vue');
    }

    public function editBook($bookId)
    {
        $book = $this->book->find($bookId);
        return Inertia::render('Books/Form/CreateOrUpdateInfo.vue', compact('book'));
    }


    public function detailPage($bookId) 
    {
        $book = Book::find($bookId);
        return Inertia::render('Books/BookDetailFolder/BookDetail', compact('book'));
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
        $bookInfo = $this->book->find($bookId);
        $updateBookData = array_merge($validData, [ $bookInfo ]);
        $bookInfo->update($updateBookData);
        // return $bookInfo;
        // $this->book->find($bookId)->update($validData);
        
    }

    public function deleteBook($bookId)
    {
        $this->book->find($bookId)->delete();
    }
}
