<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    //注册页面
    public function register()
    {
        return view('User.register');
    }

    //执行注册
    public function doRegister(Request $request)
    {
        $this->validate($request, [
            'uname' => 'required|unique:user,uname',
            'pwd' => 'required|min:6',
            'repassword' => 'required|min:6|same:pwd',
            'captcha' => 'required|captcha'
        ], [
            'required' => ':attribute 为必填项',
            'uname.unique' => ':attribute 已被注册',
            'min' => ':attribute 长度不符合要求',
            'repassword.same'=> ':attribute 与密码不匹配',
            'captcha' => ':attribute 错误',
        ], [
            'uname' => '用户名',
            'pwd' => '密码',
            'repassword' => '确认密码',
            'captcha' => '验证码'
        ]);
        $user = $request->post();
        $userService = new UserService();
        $result = $userService->check($user['uname'],md5($user['pwd']));  //接收到的为返回的用户信息
        if ($result) {
            return redirect()->action('IndexController@index');
        }else{
            return view('User.register');
        }
    }

    //登录
    public function login()
    {
        return view('User.login',['uname'=>'','pwd'=>'']);
    }

    //执行登录
    public function doLogin(Request $request)
    {
        //登录验证码
        $this->validate($request,[
            'captcha' => ['required','captcha'],
        ],[
            'captcha.required' => "验证码不能为空",
            'captcha.captcha' => "验证码错误",
        ]);
        $user = $request->post();
        $result = UserService::login($user['uname'],md5($user['pwd']));//判断是否已登录
        if($result){
            return redirect()->action('IndexController@index');  //重定向跳转方法
        }else{
            return view('Index.index',['uname'=>'']);
        }
    }

    //退出登录  退出登录
    public function loginOut(Request $request)
    {
        $uname = $request->get('uname');

        $result = UserService::loginOut($uname);
        return redirect()->action('IndexController@index');
    }

    //个人资料
    public function selfInfo()
    {
        return view('User.self_info');
    }

    public function order()
    {
        return view('User.order');
    }

}
