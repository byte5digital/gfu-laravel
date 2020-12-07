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

Route::prefix('blog')->name('blog.')->group(
    function () {
        // LARAVEL 8 SYNTAX
        // Route::get('/', [BlogEntryController::class, 'index'])->name('index');
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
        Route::get('/{blogEntry}', 'BlogEntryController@show')->name('show');
        Route::get('/', 'BlogEntryController@index')->name('index');
    }
);




Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
