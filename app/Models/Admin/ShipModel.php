<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ShipModel extends Model
{
    protected $table = 'admin_ship';
    protected $primaryKey = 'uid';

    public static function ship($uid)
    {
        $ship = self::where('uid',$uid)->get()->toArray();
        return $ship;
    }

}