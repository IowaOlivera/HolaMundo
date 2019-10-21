<?php

use Illuminate\Http\Request;
use App\Product;
use App\Http\Resources\Product as ProductResource;
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
Route::get('/greeting', function (Request $request){
    return 'Hello World!';
});
//Route::fallback(function(){
   // return response()->json([
        //'message' => 'Page Not Found. If error persists, contact info@website.com'], 404);
//});
Route::post('products', "ProductController@store");
Route::get('products', "ProductController@index");
Route::delete('products/{id}', "ProductController@destroy")->name('products.destroy');
Route::put('products/{id}', "ProductController@update")->name('products.update');
Route::get('products/{id}', "ProductController@show");
//Route::get('products/edit/{id}', "ProductController@edit");
//Route::get('products/create', "ProductController@create");
