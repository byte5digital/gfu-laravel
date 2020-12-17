<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// apiResource -> generates routes for crud operations
Route::apiResource('/blog', 'API\BlogEntryController', 
//parameter should not be named blog but blogEntry
['parameters' => [
    'blog' => 'blogEntry'
    ]
    //protect api routes with middleware api_token 
    //api_token is registered in App\Http\Kernel.php
])->middleware('api_token');

//generate resource api routes for category and protect them with middleware api_token
Route::apiResource('/category', 'API\CategoryController')
->middleware('api_token');
