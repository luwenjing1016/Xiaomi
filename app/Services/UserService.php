<?php
namespace App\Services;

use App\Jobs\SendEmail;
use App\Services;
use App\Models\UserModel;
use App\Models\LogModel;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class UserService
{
    use DispatchesJobs;
    //注册   判断 邮箱 还是手机号
    public function check($name, $pwd)
    {
        $regEmail = '/^[A-Za-z0-9]+\@[a-zA-Z0-9_-]+(\.com)$/';
        $preg = preg_match($regEmail, $name);
        $user = UserModel::registerCreate($name, $pwd, $preg);
        if($user){
            Session::put('user',$user);
            if($user->email){
                $this->sendEmail($user->uname);
            }
        }
        return $user;
    }

    //登录
    public static function login($uname, $pwd)
    {
        $ip_json = @file_get_contents("http://ip.taobao.com/service/getIpInfo.php?ip=myip");
        $ip_arr = json_decode(stripslashes($ip_json), 1);
        $ip = $ip_arr['data'];
            $data = UserModel::getUserInfo($uname, $pwd);
            if($data){
                LogModel::log($data['time'],$ip,$data['result']);
                $result = $data['result'];
                Session::put('user',$result);
            }else{
                $result = 0;
            }
        return $result;
    }

    //退出登录
    public static function loginOut($uname)
    {
        $result = UserModel::loginOut($uname);
        Session::pull('user');
        return $result;
    }
    
    //队列发送邮件
    public function sendEmail($email)
    {
        $this->dispatch(new SendEmail($email));
    }
}