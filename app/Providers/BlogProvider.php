<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BlogProvider extends ServiceProvider
{

    public $bindings = [
        BlogInterface::class => BlogStubContainer::class,
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
