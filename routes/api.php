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

Route::get('/staff', 'Item\ItemController@getStaff');
Route::post('/staff', 'Item\ItemController@addStaff');
Route::put('/staff', 'Item\ItemController@editStaff');
Route::delete('/staff', 'Item\ItemController@deleteStaff');


Route::get('/staff/export', 'Item\ItemController@exportStaff');

Route::get('/customer', 'Item\ItemController@getCustomer');
Route::get('/room', 'Item\ItemController@getRoom');
Route::get('/food', 'Item\ItemController@getFood');
