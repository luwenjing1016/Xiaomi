<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LogModel extends Model
{
    protected $table='log';
    protected $primaryKey = 'id';

    //日志查询
    public static function log($time,$ip,$result)
    {
        $count = DB::table('log')->where('uid',$result->uid)->count();//用户存在 判断登录次数
        if($count < 10){
            DB::table('log')->insert(['times'=>$time,'uid'=>$result->uid,'loginip'=>$ip['ip'],'loginurl'=>$ip['region'].$ip['city']]);
        }else if($count == 10){
            $login = DB::table('log')->where('uid',$result->uid)->orderBy('times','DESC')->first();
            DB::table('log')->where('id',$login->id)->update(['times'=>$time]);
        }
    }
}
