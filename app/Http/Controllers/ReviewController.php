<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendReviewRequest;
use App\Http\Requests\UpdateReviewRequest;


class ReviewController extends Controller
{

    public function create(SendReviewRequest $request)
    {
        // $findReview = Review::where([
        //     'user_id' => Auth::user()->id,
        //     'book_id' => $request->book_id
        // ])->first();
        // dd($findReview);
        $review = Review::firstOrCreate([
            'user_id' => Auth::user()->id,
            'book_id' => $request->book_id
        ], $request->except('book_id'));
        if($review->wasRecentlyCreated) {
            return $review;

        }
        return ['error' => 'You already reviewd this book'];
    }

    public function edit(Review $review) {
        return compact('review');
    }

    public function update(Review $review, UpdateReviewRequest $request)
    {
        $validData = $request->validated();
        $this->authorize('update', $review);
        $review->update($validData);
        return $review;
    }


    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
    }
}

