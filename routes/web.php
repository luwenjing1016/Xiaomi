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
/*
 * 后台路由
 * */
Route::get('admin/login',function(){
    return view('admin.login');
});


/*
 * 前台路由
 * */
Route::get('index',"IndexController@index");
Route::get('liebiao',"IndexController@liebiao");
Route::get('details',"IndexController@details");
Route::get('shopcart',"Xiaomi/IndexController@shopcart");


Route::get('login',"UserController@login");
Route::get('loginout',"UserController@loginout");
Route::post('doLogin',"UserController@doLogin");
Route::post('doRegister',"UserController@doRegister");
Route::get('register',"UserController@register");
Route::get('selfInfo',"UserController@selfInfo");
Route::get('order',"UserController@order");
Route::get('show',"Test1Controller@show");




