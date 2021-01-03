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

//Route::middleware('auth:api')->get('/user', function (Request $request) {

//    return $request->user();
//});

   /* Route::get('businesses', function() {
                return Business::all();
    });
    Route::get('businesses/{id}', function($id) {
    return Business::find($id);
    });
    Route::post('businesses', function(Request $request) {
        return Business::create($request->all());
    });
    Route::put('businesses/{id}', function(Request $request, $id) {
        $business = Business::findOrFail($id);
        $business->update($request->all());
        return $business;
    });
    Route::delete('businesses/{id}', function($id) {
        Business::find($id)->delete();
    return 204;
    });*/

    //Route::get('users', 'App\\Http\\Controllers\\UserController@index');
    //Route::get('users/{user}', 'App\\Http\\Controllers\\UserController@show');
    //Route::post('users', 'App\\Http\\Controllers\\UserController@store');
    //Route::put('users/{user}', 'App\\Http\\Controllers\\UserController@update');
    //Route::delete('users/{user}', 'App\\Http\\Controllers\\UserController@delete');


    Route::post('register', 'App\\Http\\Controllers\\UserController@register');
    Route::post('login', 'App\\Http\\Controllers\\UserController@authenticate');
    Route::get('businesses', 'App\\Http\\Controllers\\BusinessController@index');
    Route::get('books', 'App\\Http\\Controllers\\BookController@index');

    Route::group(['middleware' => ['jwt.verify']], function() {

        Route::get('user', 'App\\Http\\Controllers\\UserController@getAuthenticatedUser');

        //CHAT
        Route::get('chat', 'App\\Http\\Controllers\\ChatController@index');
        Route::get('chat/{chat}', 'App\\Http\\Controllers\\ChatController@show');
        Route::post('chat', 'App\\Http\\Controllers\\ChatController@store');
        Route::put('chat/{chat}', 'App\\Http\\Controllers\\ChatController@update');
        Route::delete('chat/{chat}', 'App\\Http\\Controllers\\ChatController@delete');

        //BUSINESSES
        Route::get('businesses/{business}', 'App\\Http\\Controllers\\BusinessController@show');
        Route::post('businesses', 'App\\Http\\Controllers\\BusinessController@store');
        Route::put('businesses/{business}', 'App\\Http\\Controllers\\BusinessController@update');
        Route::delete('businesses/{business}', 'App\\Http\\Controllers\\BusinessController@delete');

        //BOOKS
        Route::get('books/{book}', 'App\\Http\\Controllers\\BookController@show');
        Route::post('books', 'App\\Http\\Controllers\\BookController@store');
        Route::put('books/{book}', 'App\\Http\\Controllers\\BookController@update');
        Route::delete('books/{book}', 'App\\Http\\Controllers\\BookController@delete');
    });
