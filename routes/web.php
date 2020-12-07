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
        Route::get('/', 'BlogEntryController@index')->name('index');
        Route::middleware(['auth'])->group(
            function () {
                Route::get('/create', 'BlogEntryController@create')->name('create');
                Route::post('/store', 'BlogEntryController@store')->name('store');

            }
        );
    }
);




Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');
