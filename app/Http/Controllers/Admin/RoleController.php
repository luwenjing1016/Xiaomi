<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService\MenuService;
use App\Services\AdminService\RoleService;
use Illuminate\Http\Request;
use App\Services\AdminService\StaffService;

class  RoleController extends Controller
{
    public function show()
    {
        $roles = RoleService::showRole();
        $buttons = StaffService::resource();
//        dd($buttons);
        return view('Admin.Role.show',['roles'=>$roles,'buttons'=>$buttons]);
    }
    //角色添加
    public function role()
    {
        return view('Admin.Role.add');
    }
    public function addRole(Request $request)
    {
        $addRole = $request->post();
        RoleService::addRole($addRole);
        return redirect()->action('Admin\RoleController@show');
    }
    //角色删除
    public function doDelete()
    {
        $rid = $_GET['rid'];
        RoleService::deleteRole($rid);
        return redirect()->action('Admin\RoleController@show');
    }
    //角色修改
    public function updateRole()
    {
        $rid = $_GET['rid'];
        $role = RoleService::updateRole($rid);
        return view('Admin.Role.update',['role'=>$role]);
    }

    public function doUpdate(Request $request)
    {
        $roleMsg = $request->post();
        RoleService::doUpdate($roleMsg);
        return redirect()->action('Admin\RoleController@show');
    }

    //角色分配权限
    public function allot()
    {
        $roles = RoleService::showRole();//查询所有角色
        $menuService = new MenuService();
        $powers = $menuService->checkMenu();//查询权限表
        $buttons = RoleService::buttons();
//        dd($powers);
        return view('Admin.Role.allot',['roles'=>$roles,'powers'=>$powers,'buttons'=>$buttons]);
    }
    public function allotRole(Request $request)
    {
        $allots = $request->post();
//        $allots = $request->get('mid');
//        dd($allots);die;
        RoleService::allotRole($allots);
        return redirect()->action('Admin\RoleController@show');
    }
}