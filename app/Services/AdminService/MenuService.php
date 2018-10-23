<?php
namespace App\Services\AdminService;

use App\Models\Admin\MenuModel;
use App\Models\Admin\UserModel;
use Illuminate\Support\Facades\Session;

class MenuService
{
    //菜单查询
    public static function menu()
    {
        $admin = Session::get('adminUser');
        $menus = new UserModel();
//
        $menu = $menus->menu($admin);
//        dd($menu);
        return $menu;
    }

    //无限极分类
    public function menus()
    {
        $menus = MenuModel::menus();
       //dd($menus);
        return $this->category($menus);
    }

    public static function category($menus,$pid=0,$level=0){
        static $list=[];
        foreach($menus as $key => $value){
            if($value['pid']==$pid){
                $flg = str_repeat('——|',$level);
                $value['text']=$flg.$value['text'];
                $list[]=$value;
                MenuService::category($menus,$value['mid'],$level+1);
            }
        }
        return $list;
    }

    //权限添加
    public static function addPower($newPower)
    {
        return MenuModel::addPower($newPower);
    }
    //权限删除
    public static function deletePower($mid)
    {
        return MenuModel::deletePower($mid);
    }
    //修改权限信息
    public static function update($mid)
    {
        return MenuModel::updateMsg($mid);
    }
    public static function doUpdate($upPower)
    {
        return MenuModel::doUpdate($upPower);
    }

    //分配权限页面权限展示
    public  function checkMenu()
    {
        $menus = MenuModel::checkMenu();
        foreach($menus as $key => $value){
            $menus[$key]['url']=$value['url'].'?mid='.$value['mid'];
        }
        $menu = $this->getCid($menus);
        return $menu;
    }
    public function getCid($parentMenu,$name = 'submenu',$pid=0)//分配权限
    {
        $arr = [];
        foreach($parentMenu as $key => $v){
            if($v['pid'] == $pid){
                $v[$name] = $this->getCid($parentMenu,$name,$v['mid']);
                $arr[]=$v;
            }
        }
        return $arr;
    }
}