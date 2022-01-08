<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\AuthorizationException;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        //
    }

    public function view(User $user, Book $book)
    {
        //
    }

    public function create(User $user)
    {
        //
    }

    public function update(User $user, Book $book)
    {
        return $user->id === $book->user_id;
    }

    public function delete(User $user, Book $book)
    {
        return $user->id === $book->user_id;

    }

    public function restore(User $user, Book $book)
    {
        //
    }

    public function forceDelete(User $user, Book $book)
    {
        //
    }
}
