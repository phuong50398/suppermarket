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
// Route::resource('danhmuc', 'HomeController');
// Route::get('category', 'CategoryGroupController@index');
Route::get('home', 'ProductController@index');
Route::get('groupProduct/{name}/{type}', 'ProductController@GroupProduct');
