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

//Route::get('admin/home',function(){
//    return view('admin.admin');
//});
Route::get('admin/login',"Admin\AdminController@login");
Route::post('admin/dologin',"Admin\AdminController@dologin");
Route::middleware(['admin'])->namespace('Admin')->group(function(){
    //管理员管理
    Route::get('admin/menu',"AdminController@menu");

    Route::get('admin/show',"TableController@show");

    Route::get('admin/add',"TableController@add");
    Route::post('admin/doAdd',"TableController@doAdd");

    Route::get('admin/doUpdate',"TableController@doUpdate");
    Route::post('admin/toUpdate',"TableController@toUpdate");

    Route::get('admin/doDelete',"TableController@doDelete");

    //角色管理
    Route::get('admin/role/show',"RoleController@show");
    Route::get('admin/role/role',"RoleController@role");
    Route::post('admin/role/addRole',"RoleController@addRole");
    Route::get('admin/role/doDelete',"RoleController@doDelete");
    Route::get('admin/role/updateRole',"RoleController@updateRole");
    Route::post('admin/role/doUpdate',"RoleController@doUpdate");
    //角色分配权限
    Route::get('admin/role/allot',"RoleController@allot");
    Route::post('admin/role/allotRole',"RoleController@allotRole");

    //权限管理
    Route::get('admin/power/show',"PowerController@show");
    Route::get('admin/power/add',"PowerController@add");
    Route::post('admin/power/addPower',"PowerController@addPower");
    Route::get('admin/power/delete',"PowerController@delete");
    Route::get('admin/power/update',"PowerController@update");
    Route::post('admin/power/doUpdate',"PowerController@doUpdate");
});

/*
 * 前台路由
 * */
Route::get('index',"IndexController@index");
Route::get('liebiao',"IndexController@liebiao");
Route::get('details',"IndexController@details");
Route::get('shopcart',"IndexController@shopcart");


Route::get('login',"UserController@login");
Route::get('loginout',"UserController@loginout");
Route::post('doLogin',"UserController@doLogin");
Route::post('doRegister',"UserController@doRegister");
Route::get('register',"UserController@register");
Route::get('selfInfo',"UserController@selfInfo");
Route::get('order',"UserController@order");
Route::get('show',"Test1Controller@show");




