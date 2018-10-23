<?php
namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ButtonModel extends Model
{
    protected $table = 'admin_button';
    protected $primaryKey = 'bid';
    public static function button()
    {
        return self::get()->toArray();
    }
}