<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GoodsModel extends Model
{
    protected $table = 'goods';
    protected $primaryKey = 'tid';
    public static function goods($sid)
    {
        $goods = self::where('sid',$sid)->get()->toArray();
        return $goods;
    }
}