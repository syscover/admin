<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea2
 * @package Syscover\Admin\Models
 */

class TerritorialArea2 extends CoreModel
{
    protected $table        = 'admin_territorial_area_2';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'country_id', 'territorial_area_1_id', 'name', 'slug'];
    public $with            = ['territorial_area_1', 'territorial_areas_3'];

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
        return $query->join('admin_territorial_area_1', 'admin_territorial_area_2.territorial_area_1_id', '=', 'admin_territorial_area_1.id')
            ->select('admin_territorial_area_1.*', 'admin_territorial_area_2.*', 'admin_territorial_area_1.name as territorial_area_1_name', 'admin_territorial_area_2.name as territorial_area_2_name');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function territorial_area_1()
    {
        return $this->belongsTo(TerritorialArea1::class, 'territorial_area_1_id', 'id');
    }

    public function territorial_areas_3()
    {
         return $this->hasMany(TerritorialArea3::class, 'territorial_area_2_id');
    }
}
