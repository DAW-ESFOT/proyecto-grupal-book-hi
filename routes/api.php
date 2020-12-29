<?php
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Use App\Models\Chat;

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

Route::get('chat', function() {
    return Chat::all();
});
Route::get('chat/{id}', function($id) {
    return Chat::find($id);
});
Route::post('chat', function(Request $request) {
    return Chat::create($request->all());
});
Route::put('chat/{id}', function(Request $request, $id) {
    $article = Chat::findOrFail($id);
    $article->update($request->all());
    return $article;
});
Route::delete('chat/{id}', function($id) {
    Chat::find($id)->delete();
    return 204;
});

 /*   return $request->user();
 });
    Route::get('businesses', function() {
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
    });
*/

