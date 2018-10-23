<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    protected $table='admin_user';
    protected $primaryKey='uid';
    public $timestamps=false;

    /*SELECT * from amdin_button WHERE menu_id in(
        *SELECT mid from admin_menu WHERE mid in (
        *SELECT resource_id from admin_rolesource WHERE resource_type=0 and role_id=(
        *SELECT rid from admin_role WHERE rid=(
        *select rid from admin_ship WHERE uid=(
        *SELECT uid FROM admin_user WHERE email='22@qq.com' AND `password`='123'
        *)))));
        **/

    public function user($adminUser)
    {
        //查询用户
        $user = self::where('email',$adminUser['email'])->where('password',$adminUser['password'])->get()->toArray();
//        dd($user);
        return $user;
    }

    public function menu($admin)
    {
        $rid = ShipModel::ship($admin[0]['uid']);//通过关系表查角色id
        $role = RoleModel::role($rid);//通过角色id在角色表查角色
        $resource = RolesourceModel::rolesource($role['rid']); //通过角色id在角色资源表查权限
        $ids =[];
        $resource_types = [];
        foreach($resource as $key => $value){
            $ids[] = $value['resource_id'];
            $resource_types[] = $value['resource_type'];
        }
        $menus = MenuModel::menu($ids);
        foreach($menus as $key => $value){
            $menus[$key]['url']=$value['url'].'?mid='.$value['mid'];
        }
        $menu = $this->getCid($menus);
        return $menu;
    }

    public function getCid($parentMenu,$name = 'submenu',$pid=0)
    {
        $arr = [];
        foreach($parentMenu as $key => $v){
            if($v['pid'] == $pid){
                $v[$name] = $this->getCid($parentMenu,$name,$v['mid']);
                $arr[]=array_filter($v);//删除数组中的空值元素（没有值的字段）
            }
        }
        return $arr;
    }

    public static function users()
    {
        $user = Session::get('adminUser');
//        dd($user);
        $users =  self::where('status',1)->where('uid','!=',$user[0]['uid'])->get()->toArray();
        return $users;
    }

    //添加
    public static function add($addAdmin)
    {
        $result = self::where([
                        'uname'=>$addAdmin['uname'],
                        'password'=>$addAdmin['password'],
                        'email'=>$addAdmin['email'],
                        ])->get()->toArray();
        if($result){
            return false;
        }else{
            $user = Session::get('adminUser');
//            var_dump($user);die;
            $data = [
                'uname' => $addAdmin['uname'],
                'email' => $addAdmin['email'],
                'mobile' => $addAdmin['mobile'],
                'password' => $addAdmin['password'],
                'lasttime' => '',
                'is_supper' => $addAdmin['is_supper'],
                'is_freeze' => $addAdmin['is_freeze'],
                'referee' => $user[0]['uid'],
                'status' => 1
            ];
            $res = DB::table('admin_user')->insert($data);
            $uid = DB::table('admin_user')->where('uname',$addAdmin['uname'])->value('uid');
            foreach($addAdmin['role'] as $key => $roles){
                $ship = ['uid'=>$uid,'rid'=>$roles];
                DB::table('admin_ship')->insert($ship);
            }
            return true;
        }
    }

    //修改
    public static function doUpdate($uid)
    {
        $adminMessage = self::where('uid',$uid)->where('status',1)->get()->toArray();
        return $adminMessage;
    }
    public static function toUpdate($updateMessage)
    {
        $data = [
            'uname' => $updateMessage['uname'],
            'email' => $updateMessage['email'],
            'mobile' => $updateMessage['mobile'],
            'password' => $updateMessage['password'],
            'lasttime' => '',
            'is_supper' => $updateMessage['is_supper'],
            'is_freeze' => $updateMessage['is_freeze'],
        ];
        $update = self::where('uid',$updateMessage['uid'])->update($data);
        if($update){
            return true;
        }else{
            return false;
        }
    }

    //删除
    public static function doDelete($uid)
    {
        return self::where('uid',$uid)->update(['status'=>0]);
    }
}