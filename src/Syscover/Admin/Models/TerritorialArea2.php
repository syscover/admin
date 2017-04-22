<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea2
 * @package Syscover\Admin\Models
 */

class TerritorialArea2 extends CoreModel
{
    protected $table        = 'territorial_area_2';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'                => 'required|between:1,10|unique:territorial_area_2,id',
        'name'              => 'required|between:2,50',
        'territorialArea1'  => 'not_in:null'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule'])   static::$rules['id'] = 'required|between:1,10';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query
            ->join('country', 'territorial_area_2.country_id', '=', 'country.id')
            ->join('territorial_area_1', 'territorial_area_2.territorial_area_1_id', '=', 'territorial_area_1.id')
            ->select('country.*', 'territorial_area_1.*', 'territorial_area_2.*', 'country.name as country_name', 'territorial_area_1.name as territorial_area_1_name', 'territorial_area_2.name as territorial_area_2_name');
    }

    public function territorialAreas3()
    {
         return $this->hasMany(TerritorialArea3::class, 'territorial_area_2_id');
    }
}
