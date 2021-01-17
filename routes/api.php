<?php

use Illuminate\Support\Facades\Route;

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

    Route::post('register', 'App\\Http\\Controllers\\UserController@register');
    Route::post('login', 'App\\Http\\Controllers\\UserController@authenticate');
    //Route::get('users', 'App\\Http\\Controllers\\UserController@index');
    Route::get('books', 'App\\Http\\Controllers\\BookController@index');
    Route::get('books/{book}', 'App\\Http\\Controllers\\BookController@show');
    Route::get('categories', 'App\\Http\\Controllers\\CategoryController@index');
    Route::get('categories/{category}', 'App\\Http\\Controllers\\CategoryController@show');

    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::get('user', 'App\\Http\\Controllers\\UserController@getAuthenticatedUser');
        Route::get('users/{user}', 'App\\Http\\Controllers\\UserController@show');
        Route::put('users/{user}', 'App\\Http\\Controllers\\UserController@update');

        //CHAT
        Route::get('chats', 'App\\Http\\Controllers\\ChatController@index');
        Route::get('chats/{chat}', 'App\\Http\\Controllers\\ChatController@show');
        Route::post('chats', 'App\\Http\\Controllers\\ChatController@store');
        Route::put('chats/{chat}', 'App\\Http\\Controllers\\ChatController@update');
        Route::delete('chats/{chat}', 'App\\Http\\Controllers\\ChatController@delete');

        //MESSAGES
        Route::get('messages', 'App\\Http\\Controllers\\MessageController@index');
        Route::get('messages/{message}', 'App\\Http\\Controllers\\MessageController@show');
        Route::post('messages', 'App\\Http\\Controllers\\MessageController@store');
        Route::put('messages/{message}', 'App\\Http\\Controllers\\MessageController@update');
        Route::delete('messages/{message}', 'App\\Http\\Controllers\\MessageController@delete');

        //BOOKS
        Route::get('users/{user}/books', 'App\\Http\\Controllers\\BookController@showmybooks');
        Route::get('users/{user}/books/{book}', 'App\\Http\\Controllers\\BookController@showmybook');
        Route::post('users/books', 'App\\Http\\Controllers\\BookController@store');
        Route::put('books/{book}', 'App\\Http\\Controllers\\BookController@update');
        Route::delete('books/{book}', 'App\\Http\\Controllers\\BookController@delete');

        //CATEGORIES
        //Route::put('categories/{category}', 'App\\Http\\Controllers\\CategoryController@update');

    });
