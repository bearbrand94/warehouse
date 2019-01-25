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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//item services
Route::get('/client/item/get', 'ItemService@get_client_item');
Route::get('/item/detail/get', 'ItemService@get_item_detail');
Route::post('/item/add', 'ItemService@add_new_item');

Route::get('/item/transactions/get', 'TransactionService@get_item_transaction');
Route::get('/client/transactions/get', 'TransactionService@get_client_transaction');