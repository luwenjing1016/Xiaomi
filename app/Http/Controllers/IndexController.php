<?php

namespace App\Http\Controllers;

use App\Models\TypeModel;
use App\Services\ListService;
use App\Services\TypeService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class IndexController extends Controller
{
    public function index()
    {

        //session user  sdjfla注册用户  user1 登录用户
        $user = Session::get('user');

        $menu = TypeService::getType();
//        echo "<pre>";
//        dd($menu);die;
        if($user){
            $uname = $user->mobile.$user->email;
            return view('Index.index',['uname'=>$uname,'menus'=>$menu]);
        }else{
            return view('Index.index',['uname'=>'','menus'=>$menu]);
        }
    }
    public function liebiao(Request $request)  //列表
    {
        $type = $request->get('type');
//        var_dump($type);die;
        $list = ListService::getGoods($type);
//        echo "<pre>";
//        var_dump($list);die;
        return view('Index.liebiao',['list'=>$list]);
    }
    public function details() //详情
    {
        return view('Index.details');
    }
    public function shopcart()  //购物车
    {
        return view('Index.shopcart');
    }

    public function getCid($type,$name='child',$pid=0)
    {
        $arr = [];
        foreach($type as $v){
            if($v->pid == $pid){
                $v->$name = $this->getCid($type,$name,$v->sid);
                $arr[]=$v;
            }
        }
        return $arr;
    }

}
