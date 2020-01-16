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

Route::get('/', function () {
    return view('costumer/reserve');
});
Route::get('/generate-code', 'GenerateController@display');
//order stage
Route::post('/order', 'TransactionController@stageone');
Route::post('/reorder', 'TransactionController@reorder')->name('reorder');
Route::post('/preparing', 'TransactionController@stagetwo');
Route::post('/request', 'RequestController@store');
Route::get('/done/{id}', 'TransactionController@stagethree')->name('done');
Route::get('/qrto/{userid}/{pass}', 'TransactionController@qrRetrive')->name('qr');
Route::get('/testdb', 'TransactionController@test')->name('test');

//admin
Route::post('/status-change', 'AdminController@changeStatus');
Auth::routes();

Route::get('/admin', 'HomeController@index')->name('home');
Route::resource('table', 'TableController');
Route::resource('food', 'MenuController');
Route::resource('category', 'CategoryController');
Route::post('category/destroy', 'CategoryController@destroy')->name('category.remove');
Route::post('table/destroy', 'TableController@destroy')->name('table.remove');
Route::post('food/destroy', 'MenuController@destroy')->name('food.remove');
Route::post('food/feat', 'MenuController@feat')->name('food.feat');
Route::post('food/active', 'MenuController@active')->name('food.availability');
