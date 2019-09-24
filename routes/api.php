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
Route::get('/greeting', function (Request $request){
    return 'Hello World!';
});
Route::post('products', "ProductController@store");
Route::get('products', "ProductController@index");
Route::delete('products/{id}', "ProductController@destroy");
Route::put('products/{id}', "ProductController@update");
Route::get('products/show/{id}', "ProductController@show");
Route::get('products/edit/{id}', "ProductController@edit");
Route::get('products/create', "ProductController@create");
