<?php
namespace App\Services;

use App\Models\TypeModel;
use App\Services;
use Illuminate\Http\Request;

class TypeService
{
    public static function getType()
    {
        $typeModel = new TypeModel();
        $res = $typeModel->getType();
        return $res;
    }

}