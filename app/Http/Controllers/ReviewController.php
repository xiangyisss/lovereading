<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Inertia\Inertia;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\SendReviewRequest;
 

class ReviewController extends Controller
{   
    public function __construct(Review $review)
    {
        $this->review = $review;
    }

    public function index()
    {
        $reviews = $this->review->get();
        return $reviews;
    }

    public function createReview(SendReviewRequest $request)
    {   
        $validData = $request->validated();
        $createdReview = $this->review
        ->create(
            array_merge(
                $validData, ['user_id' => Auth::user()->id]
            )
        );
        return $createdReview;
    }
}
