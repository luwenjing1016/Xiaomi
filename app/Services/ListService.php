<?php
namespace App\Services;

use App\Models\TypeModel;

class ListService
{
    public static function getGoods($type)
    {
        $goods = TypeModel::getGoods($type);
        return $goods;
    }

}