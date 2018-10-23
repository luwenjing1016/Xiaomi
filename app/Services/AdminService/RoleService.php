<?php
namespace App\Services\AdminService;

use App\Models\Admin\ButtonModel;
use App\Models\Admin\RoleModel;
use App\Models\Admin\RolesourceModel;
use App\Models\Admin\ShipModel;

class RoleService
{
    public static function showRole()
    {
        return RoleModel::roles();
    }
    //菜单栏列表查询
    public static function adminRole($rid)
    {
        return RoleModel::adminRole($rid);
    }
    //添加角色
    public static function addRole($addRole)
    {
        return RoleModel::addRole($addRole);
    }
    //删除角色
    public static function deleteRole($rid)
    {
        return RoleModel::deleteRole($rid);
    }
    //关系表
    public static function shipRole($uid)
    {
        return ShipModel::ship($uid);
    }
    //角色修改
    public static function updateRole($rid)
    {
        return RoleModel::role($rid);
    }
    public static function doUpdate($roleMsg)
    {
        return RoleModel::doUpdate($roleMsg);
    }
    //角色分配
    public static function allotRole($allots)
    {
        return RolesourceModel::allotRole($allots);
    }
    //查询按钮表
    public static function buttons()
    {
        return ButtonModel::button();
    }
}