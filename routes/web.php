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
//
Route::get('master/client', 'MasterController@master_client_list');
Route::get('master/client/new', 'MasterController@master_client_new');
Route::get('master/client/edit', 'MasterController@master_client_edit');
Route::get('master/client/detail', 'MasterController@master_client_detail');
Route::get('master/item', 'MasterController@master_item_list');
Route::get('master/item/detail', 'MasterController@master_item_detail');
Route::get('master/transaction', 'MasterController@master_transaction_form');
































// client services
Route::post('/client/add', 'ClientService@add_new_client');
Route::post('/client/edit', 'ClientService@edit_client');

// item services
Route::get('/client/item/get', 'ItemService@get_client_item');
Route::get('/item/detail/get', 'ItemService@get_item_detail');
Route::get('/item/fees/get', 'ItemService@get_item_fees');
Route::post('/item/add', 'ItemService@add_new_item');
Route::post('/item/edit', 'ItemService@edit_item');
//itemlog
Route::post('/item/log/add', 'ItemService@add_item_log');

// transaction services
Route::get('/item/transactions/get', 'TransactionService@get_item_transaction');
Route::get('/client/transactions/get', 'TransactionService@get_client_transaction');