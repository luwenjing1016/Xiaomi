<?php
namespace App\Services\AdminService;

use App\Models\Admin\ShipModel;
use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Session;

class UserService
{
    public static function loginUser($adminUser)
    {
        $sessionUser = Session::get('adminUser');
//        dd($sessionUser);
//        dd($adminUser);
        $sessionData = [
            'email'=>$sessionUser[0]['email'],
            'password'=>$sessionUser[0]['password'],
        ];
        $adminData = [
            'email'=>$adminUser['email'],
            'password'=>$adminUser['password'],
        ];
        if($adminData == $sessionData && $sessionUser[0]['is_freeze']==1){ //上次登录和这次登录用户一样
            $userRole = ShipModel::ship($sessionUser[0]['uid']);
            Session::put('userRole',$userRole);
            return true;
        }else if($adminData == $sessionData && $sessionUser[0]['is_freeze']==0) {
            return false;
        }else{
            $user = new UserModel();
            $admin = $user->user($adminUser);
//            dd($admin);
            if(!empty($admin)){
                Session::put('adminUser',$admin);
                $sessionUser = Session::get('adminUser');
//                dd($sessionUser);
                $userRole = ShipModel::ship($sessionUser[0]['uid']);
                Session::put('userRole',$userRole);
//                dd(Session::get('userRole'));
                if($admin[0]['is_freeze']==1){
                    return 1;
                }else if($admin[0]['is_freeze']==0){
                    return 2;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }
    }

    public static function users()
    {
        return UserModel::users();
    }
}