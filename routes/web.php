<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// set prefix for uri and prefix for name and group routes
Route::prefix('blog')->name('blog.')->group(
    function () {
        //group route under middleware auth
        Route::middleware(['auth'])->group(
            function () {
                Route::get('/create', 'BlogEntryController@create')->name('create');
                Route::post('/store', 'BlogEntryController@store')->name('store');
                Route::get('/edit/{blogEntry}', 'BlogEntryController@edit')
                    ->name('edit');
                Route::post('/update/{blogEntry}', 'BlogEntryController@update')
                    ->name('update');
                Route::delete('/delete/{blogEntry}', 'BlogEntryController@destroy')
                    ->name('delete');
            }
        );
        //we dont want show and index behind auth middleware, so we exclude those form the group above
        Route::get('/{blogEntry}', 'BlogEntryController@show')->name('show');
        Route::get('/', 'BlogEntryController@index')->name('index');
        // LARAVEL 8 SYNTAX
        // Route::get('/', [BlogEntryController::class, 'index'])->name('index');
    }
);

// Resourceful routes protected with middleware auth, except index + show -> to show routes use 'php artisan route:list'
Route::resource('category', 'CategoryController', ['except' => ['index', 'show']])->middleware('auth');

// Routes for index + show grouped
Route::prefix('category')->name('category.')->group(
    function () {
        Route::get('/{category}', 'CategoryController@show')->name('show');
        Route::get('/', 'CategoryController@index')->name('index');
    }
);

//route for blog entries of a specific category
Route::get('/blog/category/{category}', 'BlogEntryController@indexCategorized')
    ->name('blog.categorized');

//auth routes have mail verification
Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

//route for admin.index view protected by middleware auth and is_admin
//is_admin is registered in App\Http\Kernel.php
Route::get('/admin', function () {
    return view('admin.index');
})
    ->middleware(['auth', 'is_admin'])
    ->name('admin.index');

//test route for job to send custom mail
Route::get('test-email', 'JobController@enqueue');
