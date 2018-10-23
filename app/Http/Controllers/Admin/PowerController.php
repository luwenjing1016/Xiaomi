<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService\MenuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Services\AdminService\StaffService;


class PowerController extends Controller
{
    public function show()
    {
        Session::get('adminUser');
        $menuService = new MenuService();
        $powers = $menuService->menus();
        $buttons = StaffService::resource();
        return view('Admin.power.show',['powers'=>$powers,'buttons'=>$buttons]);
    }
    //权限添加
    public function add()
    {
        $menuService = new MenuService();
        $powers = $menuService->menus();
        return view('Admin.Power.add',['powers'=>$powers]);
    }

    public function addPower(Request $request)
    {
        $newPower = $request->post();
        MenuService::addPower($newPower);
        return redirect()->action("Admin\PowerController@show");
    }
    //删除权限
    public function delete()
    {
        $mid = $_GET['mid'];
        MenuService::deletePower($mid);
        return redirect()->action("Admin\PowerController@show");
    }
    //修改权限
    public function update()
    {
        $mid = $_GET['mid'];
        $menuService = new MenuService();
        $powers = $menuService->menus();
        $updateMsg = MenuService::update($mid);
        return view('Admin.Power.update',['updateMsg'=>$updateMsg[0],'powers'=>$powers]);
    }

    public function doUpdate(Request $request)
    {
        $upPower = $request->post();
        MenuService::doUpdate($upPower);
        return $this->show();
    }
}