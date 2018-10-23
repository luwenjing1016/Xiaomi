<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RoleModel extends Model
{
    protected $table = 'admin_role';
    protected $primaryKey = 'rid';
    public $timestamps = false;

    //菜单栏查询
    public static function role($rids)
    {
        foreach($rids as $key => $r){
            $rid[$key]=$r['rid'];
        }
//        dd($rid);
        $roles = self::where('rid',$rid)->get()->toArray();
//        dd($roles[0]);
        return $roles[0];
    }
    //管理员角色添加
    public static function adminRole($rid)
    {
        $roles = self::get()->toArray();
        return $roles;
    }

    //角色管理查询
    public static function roles()
    {
        $role = self::get()->toArray();
        return $role;
    }

    //角色添加
    public static function addRole($addRole)
    {
        $role = self::where('rname',$addRole['rname'])->get()->toArray();
        if($role){
            return false;
        }else{
            DB::table('admin_role')->insert(['rname'=>$addRole['rname']]);
            return true;
        }
    }

    public static function deleteRole($rid)
    {
        return self::where('rid',$rid)->delete();
    }
    //角色信息修改
    public static function doUpdate($roleMsg)
    {
        return self::where('rid',$roleMsg['rid'])->update(['rname'=>$roleMsg['rname']]);
    }
}