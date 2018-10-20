<?php
namespace App\Models;

use App\Services\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'sid';
    //注册
    public static function registerCreate($name,$pwd,$check)
    {
//        return $name;
        $result = DB::table('user')->where('email',$name)->orwhere('mobile',$name)->where('pwd',$pwd)->first();
//        return $result;
        if($result != ''){
            return 0;
        }else{
            //调用服务器层
            $time = date('Y-m-d H:i:s');
            if($check==1){//邮箱注册
                DB::table('user')->insert(['email'=>$name,'pwd'=>$pwd,'registertime'=>$time,'logintime'=>$time]);
            }else{ //手机注册
                DB::table('user')->insert(['mobile'=>$name,'pwd'=>$pwd,'registertime'=>$time,'logintime'=>$time]);
            }
            $user = DB::table('user')->where('email',$name)->orwhere('mobile',$name)->where('pwd',$pwd)->first();
            return $user;
        }
    }

    //登录
    public static function getUserInfo($uname,$pwd)
    {
        $result = DB::table('user')->where('email',$uname)->orwhere('mobile',$uname)->where('pwd',$pwd)->first();
        if($result != ''){
            $time = date('Y-m-d H:i:s');
            DB::table('user')->where('email',$uname)->orwhere('mobile',$uname)->update(['logintime'=>$time,'status'=>1]);
            $data = ['result'=>$result,'time'=>$time];
            return $data;
        }else{
            return 0;
        }
    }

    //退出登录
    public static function loginOut($uname)
    {
        return DB::table('user')->where('email',$uname)->orwhere('mobile',$uname)->update(['status'=>0]);
    }

}