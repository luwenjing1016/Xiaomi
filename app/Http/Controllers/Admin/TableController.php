<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AdminService\AdminService;
use App\Services\AdminService\RoleService;
use App\Services\AdminService\StaffService;
use App\Services\AdminService\UserService;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class TableController extends Controller
{
    public function show()
    {
//        Session::pull('adminUser');
        $users = UserService::users();
        $buttons = StaffService::resource();
        return view('Admin.show',['users'=>$users,'buttons'=>$buttons]);
    }
    //添加
    public function add()
    {
        $user = Session::get('adminUser');
        $userRole = RoleService::shipRole($user[0]['uid']);
        $roles = RoleService::adminRole($userRole);
//        dd($roles);
        return view('Admin.add',['roles'=>$roles]);
    }
    public function doAdd(Request $request)
    {
        $addAdmin = $request->post();
//        dd($addAdmin);die;
        $result = AdminService::add($addAdmin);
        if($result){
            return redirect()->action('Admin\TableController@show');
        }
    }
    //修改
    public function doUpdate()
    {
        $uid = $_GET['uid'];
        $adminMessage = AdminService::update($uid);
        return view('Admin.doUpdate',['adminMessage'=>$adminMessage[0]]);
    }
    public function toUpdate(Request $request)
    {
        $updateMassage = $request->post();
        $result = AdminService::toUpdate($updateMassage);
        return redirect()->action('Admin\TableController@show');
    }
    //删除
    public function doDelete()
    {
        $uid = $_GET['uid'];
//        dd($uid);
        $result = AdminService::doDelete($uid);
        return redirect()->action('Admin\TableController@show');
    }
}