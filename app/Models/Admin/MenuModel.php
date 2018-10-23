<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuModel extends Model
{
    protected $table = 'admin_menu';
    protected $primaryKey = 'mid';
    public $timestamps=false;

    public static function menu($ids)
    {
        $menus = self::where('status',1)->where('is_menu','1')->find($ids)->toArray();
        return $menus;
    }

    public static function menus()
    {
        return self::where('status',1)->where('is_menu',1)->get()->toArray();
    }

    //权限添加
    public static function addPower($newPower)
    {
        $result = self::where('text',$newPower['text'])->where('status',1)->get()->toArray();
        $data = [
            'text'=>$newPower['text'],
            'pid'=>$newPower['pid'],
            'url'=>$newPower['url'],
            'is_menu'=>$newPower['is_menu'],
        ];
        if($result){
            return false;
        }else{
            DB::table('admin_menu')->insert($data);
            $arr = self::get()->toArray();
            $last = array_pop($arr);
            $path = $newPower['pid']."-".$last['mid'];
            DB::table('admin_menu')->where('text',$last['text'])->update(['path'=>$path]);
            return true;
        }
    }
    //权限删除
    public static function deletePower($mid)
    {
//        self::where('mid',$mid)->delete();//真删除;
        self::where('mid',$mid)->update(['status'=>0]);//假删除
        return true;
    }

    //修改权限信息
    public static function updateMsg($mid)
    {
        $updateMsg = self::where('mid',$mid)->get()->toArray();
        return $updateMsg;
    }

    public static function doUpdate($upPower)
    {
        $path = $upPower['pid']."-".$upPower['mid'];
        $newPower = [
            'text'=>$upPower['text'],
            'url'=>$upPower['url'],
            'pid'=>$upPower['pid'],
            'is_menu'=>$upPower['is_menu'],
            'path'=>$path,
        ];
        $result = self::where('mid',$upPower['mid'])->update($newPower);
        return $result;

    }

    //分配权限页面权限展示
    public static function checkMenu()
    {
        return self::where('status',1)->get()->toArray();
    }
}