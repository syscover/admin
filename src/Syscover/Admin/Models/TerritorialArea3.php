<?php namespace Syscover\Pulsar\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea3
 * @package Syscover\Pulsar\Models
 */

class TerritorialArea3 extends CoreModel
{
    protected $table        = 'territorial_area_3';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'                => 'required|between:1,10|unique:territorial_area_3,id',
        'name'              => 'required|between:2,50',
        'territorialArea1'  => 'not_in:null',
        'territorialArea2'  => 'not_in:null'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:1,10';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('territorial_area_1', 'territorial_area_3.territorial_area_1_id', '=', 'territorial_area_1.id')
            ->join('territorial_area_2', 'territorial_area_3.territorial_area_2_id', '=', 'territorial_area_2.id');
    }
}