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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// client services
Route::post('/client/add', 'Service\ClientService@add_new_client');
Route::post('/client/edit', 'Service\ClientService@edit_client');
Route::delete('/client/delete', 'Service\ClientService@delete_client');
Route::get('/client/get', 'Service\ClientService@get_client');

// item services
Route::get('/client/item/get', 'Service\ItemService@get_client_item');
Route::get('/item/detail/get', 'Service\ItemService@get_item_detail');
Route::get('/item/fees/get', 'Service\ItemService@get_item_fees');
Route::post('/item/add', 'Service\ItemService@add_new_item');
Route::post('/item/edit', 'Service\ItemService@edit_item');
Route::get('/item/get', 'Service\ItemService@get_item');

//itemlog
Route::post('/item/log/add', 'Service\ItemService@add_item_log');
Route::post('/item/log/update', 'Service\ItemService@update_item_log');
Route::post('/item/log/delete', 'Service\ItemService@delete_item_log');

// transaction services
Route::get('/item/transactions/get', 'Service\TransactionService@get_item_transaction');
Route::get('/client/transactions/get', 'Service\TransactionService@get_client_transaction');

