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

Route::get('/staff/misc', 'Item\ItemController@getStaffMisc');
Route::get('/customer/misc', 'Item\ItemController@getCustomerMisc');
Route::get('/room/misc', 'Item\ItemController@getRoomMisc');
Route::get('/food/misc', 'Item\ItemController@getFoodMisc');
Route::get('/bar/misc', 'Item\ItemController@getBarMisc');

Route::get('/staff', 'Item\ItemController@getStaff');
Route::post('/staff', 'Item\ItemController@addStaff');
Route::put('/staff', 'Item\ItemController@editStaff');
Route::delete('/staff', 'Item\ItemController@deleteStaff');

Route::get('/staff/export', 'Item\ItemController@exportStaff');
Route::get('/customer/export', 'Item\ItemController@exportCustomer');
Route::get('/room/export', 'Item\ItemController@exportRoom');
Route::get('/food/export', 'Item\ItemController@exportFood');
Route::get('/bar/export', 'Item\ItemController@exportFood');

Route::get('/customer', 'Item\ItemController@getCustomer');
Route::post('/customer', 'Item\ItemController@addCustomer');
Route::put('/customer', 'Item\ItemController@editCustomer');
Route::delete('/customer', 'Item\ItemController@deleteCustomer');

Route::get('/room', 'Item\ItemController@getRoom');
Route::post('/room', 'Item\ItemController@addRoom');
Route::put('/room', 'Item\ItemController@editRoom');
Route::delete('/room', 'Item\ItemController@deleteRoom');

Route::get('/food', 'Item\ItemController@getFood');
Route::post('/food', 'Item\ItemController@addFood');
Route::put('/food', 'Item\ItemController@editFood');
Route::delete('/food', 'Item\ItemController@deleteFood');

Route::get('/bar', 'Item\ItemController@getBar');
Route::post('/bar', 'Item\ItemController@addBar');
Route::put('/bar', 'Item\ItemController@editBar');
Route::delete('/bar', 'Item\ItemController@deleteBar');

Route::get('/staff/code/{Code}', 'Item\ItemController@getStaffByCode');

Route::get('/system/parameters', 'System\SystemController@getSystemParameters');
Route::put('/system/parameters', 'System\SystemController@editSystemParameters');