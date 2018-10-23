<?php
namespace App\Services\AdminService;

use App\Models\Admin\RolesourceModel;
use Illuminate\Support\Facades\Session;

class StaffService
{
    public static function resource()//查询角色权限
    {
        $rids = Session::get('userRole');
//        dd($rids);
        $roles = RolesourceModel::roles($rids[0]['rid']);
        if(!empty($roles)){
            foreach($roles as $key => $r){
                $role[$key] = $r['resource_id'];
            }
        }else{
            $role = [];
        }
        return $role;
    }
}