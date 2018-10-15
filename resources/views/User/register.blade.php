<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="author" content="order by dede58.com"/>
    <title>用户注册</title>
    <script src="js/jquery-1.10.2.min.js"></script>
    <link rel="stylesheet" type="text/css" href="./css/login.css">


</head>
<body>
<form  method="post" action="/doRegister">
    @csrf
    @include('Common.validator')
    <div class="regist">
        <div class="regist_center">
            <div class="regist_top">
                <div class="left fl">会员注册</div>
                <div class="right fr">
                    <a href="./index.html" target="_self" >小米商城</a>
                </div>
                <div class="clear"></div>
                <div class="xian center"></div>
            </div>
            <div class="regist_main center">
                <div class="username">
                    用&nbsp;&nbsp;户&nbsp;&nbsp;名:&nbsp;&nbsp;<input class="shurukuang" value="{{old('uname')}}" type="text" id="uname" name="uname" placeholder="请输入你的用户名或邮箱"/>
                    <span class="name">{{$errors->first('uname')}}</span>
                </div>
                <div class="username">密&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="shurukuang" value="{{old('pwd')}}" type="password" name="pwd" id="pwd" placeholder="请输入你的密码"/>
                    <span class="pwd">{{$errors->first('pwd')}}</span>
                </div>
                <div class="username">确认密码:&nbsp;&nbsp;<input class="shurukuang" value="{{old('repassword')}}" type="password" name="repassword" id="repwd" placeholder="请确认你的密码"/>
                    <span class="repwd">{{$errors->first('repassword')}}</span>
                </div>
                <div class="username">
                    <div class="left fl">验&nbsp;&nbsp;证&nbsp;&nbsp;码:&nbsp;&nbsp;<input class="yanzhengma" type="captcha" name="captcha" value="{{old('catpcha')}}" placeholder="请输入验证码"/></div>
                    <div class="right fl"><img src="{{captcha_src()}}" style="cursor: pointer" onclick="this.src='{{captcha_src()}}'+Math.random()"></div>
                    <div class="captcha"><span>{{$errors->first('captcha')}}</span></div>
                </div>
            </div>
            <div class="regist_submit">
                <input class="submit" type="submit" name="submit" value="立即注册" >
            </div>

        </div>
    </div>
</form>
</body>
</html>
<script type="text/javascript">
    $('#uname').blur(function () {
        var uname = $(this).val();
        var regEmail = /^[a-zA-Z0-9_-]+\@[a-zA-Z0-9]+(\.com)$/;
        var regMobile = /^1[3|4|5|7|8][0-9]{9}$/;
        if(regEmail.test(uname)){
            $('.name').text("邮箱注册");
        }else if(regMobile.test(uname)){
            $('.name').text("手机号注册");
        }else{
            $('.name').text("请输入手机号或邮箱");
            return false;
        }
    })
</script>