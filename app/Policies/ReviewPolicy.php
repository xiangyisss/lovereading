<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Review $review)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Review $review)
    {
        //
    }

    public function delete(User $user, Review $review)
    {
        //
    }

    public function restore(User $user, Review $review)
    {
        //
    }

    public function forceDelete(User $user, Review $review)
    {
        //
    }
}
