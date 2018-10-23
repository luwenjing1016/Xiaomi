<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RolesourceModel extends Model
{
    protected $table = 'admin_rolesource';

    public static function rolesource($rid)
    {
        return self::where('role_id',$rid)->get()->toArray();
    }
    //角色分配添加
    public static function allotRole($allots)
    {
//        dd($allots);
        $rid = $allots['rid'];
        if(!empty($allots['bid'])){
            foreach($allots['bid'] as $k => $bid){
                $button[$k] = ['role_id'=>$rid,'resource_id'=>$bid,'resource_type'=>0];
                //查询
                $role = DB::table('admin_rolesource')->where('role_id',$rid)->get();
                if(!empty($role)){
                    DB::table('admin_rolesource')->where('role_id',$rid)->delete();
                }
                DB::table('admin_rolesource')->insert($button);
            }
        }
        foreach($allots['pid'] as $key => $pid){
            $data = ['role_id'=>$rid,'resource_id'=>$pid,'resource_type'=>1];
            DB::table('admin_rolesource')->insert($data);
        }
        foreach($allots['mid'] as $k => $mid){
            $data1 = ['role_id'=>$rid,'resource_id'=>$mid,'resource_type'=>1];
            DB::table('admin_rolesource')->insert($data1);
        }
        return true;
    }

    //查询角色权限
    public static function roles($rid)
    {
       return self::where('role_id',$rid)->where('resource_type',0)->get()->toArray();
    }
}