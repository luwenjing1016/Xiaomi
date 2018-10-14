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
Route::get('index',"IndexController@index");
Route::get('liebiao',"IndexController@liebiao");
Route::get('details',"IndexController@details");
Route::get('shopcart',"Xiaomi/IndexController@shopcart");
Route::get('login',"Xiaomi/UserController@login");
Route::get('register',"Xiaomi/UserController@register");
Route::get('self_info',"Xiaomi/UserController@self_info");
Route::get('order',"Xiaomi/UserController@order");



