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
Route::post('/item/log/update', 'ItemService@update_item_log');
Route::post('/item/log/delete', 'ItemService@delete_item_log');

// transaction services
Route::get('/item/transactions/get', 'TransactionService@get_item_transaction');
Route::get('/client/transactions/get', 'TransactionService@get_client_transaction');

