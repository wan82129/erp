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

/*Route::get('/{url}', function () {
    return view('item');
})->where(['url'=>'|staff|room|food']);*/
Route::get('/', function () {
    return view('item');
});