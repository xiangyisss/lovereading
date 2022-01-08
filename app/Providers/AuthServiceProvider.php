<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Book;
use App\Policies\UserPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Book::class => UserPolicy::class,
    ];


    public function boot()
    {
        $this->registerPolicies();
        // Gate::define('delete', function($user, $book)
        //     {
        //         return $user->id == $book->user_id;
        //     }
        // );
        
    }
}
