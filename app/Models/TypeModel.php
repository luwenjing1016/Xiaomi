<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TypeModel extends Model
{
    protected $table = 'type';
    protected $primaryKey = 'sid';
    public static function getType()
    {

        $parentType = self::where('pid',0)->get();
        $typeList=[];
        //方法1：
//        foreach($parentType as $key => $topType){
//            $typeList[$key]['type'] = $topType->type;
//            foreach($typeList[$key]['type'] as $k =>$type){
//                $typeList[$k]['type1'][$key] = $type->type1;
//            }
//        }
        foreach($parentType as $key => $topType){
            if(count($topType->type)==0) continue; //没有父类 跳出循环
            $typeList[$key]['goods'] = [];
            $typeList[$key]['types'] = [];
            foreach($topType->type as $type){
                $typeList[$key]['types'][] = $type->name;
                $typeList[$key]['goods'] = array_merge($typeList[$key]['goods'], $type->goods->toArray());
            }
        }
        return $typeList;
    }
    
    //获取商品
    public static function getGoods($type)
    {
        $types = [];
//        return $type;
        $type = DB::table('type')->where('name',$type)->get()->toArray();
        $goods = GoodsModel::goods($type[0]->sid);
        return $goods;

    }

    //模型关联
    public function type() //分类
    {
        /*
         * 一对一
         * 参数1:关联模型的类名，
         * 参数2:关联模型的外键
         * 参数三:当前模型的主键
         * */
        return $this->hasMany('App\Models\TypeModel','pid','sid');
    }

    public function goods() //商品
    {
        return $this->hasMany('App\Models\GoodsModel','sid','sid');
    }


}