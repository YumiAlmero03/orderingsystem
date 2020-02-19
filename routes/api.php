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
    return '$request->user()';
});
Route::middleware('api')->get('status/{id}', 'ApiController@costumerStatus')->name('apistat');
Route::middleware('api')->get('costumers', 'ApiController@getCostumers')->name('apicostumers');
<<<<<<< HEAD
Route::middleware('api')->get('request-list', 'ApiController@getRequest')->name('apirequest');

=======
Route::middleware('api')->get('costumers/{id}', 'ApiController@getCostumer')->name('apicostumer');
>>>>>>> gitpod
// Route::resource('/cruds', 'CrudsController', [
  // 'except' => ['edit', 'show', 'store']
// ]);
