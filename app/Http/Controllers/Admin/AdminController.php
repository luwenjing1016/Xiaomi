<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin\MenuModel;
use App\Models\Admin\UserModel;
use App\Services\AdminService\MenuService;
use App\Http\Controllers\Controller;
use App\Services\AdminService\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //后台登录
    public function login()
    {
//        Session::pull('adminUser');die;
        return view('Admin.login');
    }

    public function doLogin(Request $request)
    {
        $this->validate($request,[
            'email'=> ['required'],
            'password'=>['required']
        ],[
            'required' => '不能为空',
        ]);
        $adminUser = $request->input();
        $user = UserService::loginUser($adminUser);
        if($user==1){
            return redirect()->action('Admin\TableController@show');
        }else if($user == 2){
            return  view('Admin.login');
        }else{
            return redirect()->action('Admin\AdminController@login');
        }
    }

    public static function menu()
    {
        $menus = MenuService::menu();
        return $menus;
    }
}