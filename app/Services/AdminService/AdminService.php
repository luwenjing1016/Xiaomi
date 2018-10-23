<?php
namespace App\Services\AdminService;

use App\Models\Admin\RoleModel;
use App\Models\Admin\ShipModel;
use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Session;

class AdminService
{
    public static function add($addAdmin)
    {
        $result = UserModel::add($addAdmin);//添加用户除角色外的信息
        if($result){
            return true;
        }else{
            return redirect()->action('Admin\TableController@show');
        }
    }
    public static function update($uid)
    {
        $result = UserModel::doUpdate($uid);
        return $result;
//        dd($result);
    }
    public static function toUpdate($updateMessage)
    {
        $result = UserModel::toUpdate($updateMessage);
        return $result;
    }
    public static function doDelete($uid)
    {
        $result = UserModel::doDelete($uid);
        return $result;
    }
}