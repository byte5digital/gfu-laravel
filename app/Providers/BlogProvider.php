<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Contracts\BlogInterface;
use App\Services\BlogStubContainer;
use App\Services\BlogMysqlContainer;

class BlogProvider extends ServiceProvider
{
    public $bindings = [
        BlogInterface::class => BlogMysqlContainer::class,
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
