<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea3
 * @package Syscover\Admin\Models
 */

class TerritorialArea3 extends CoreModel
{
    protected $table        = 'admin_territorial_area_3';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'country_id', 'territorial_area_1_id', 'territorial_area_2_id', 'name', 'slug'];
    public $with            = ['territorial_area_1', 'territorial_area_2'];

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
        return $query->join('admin_territorial_area_1', 'admin_territorial_area_3.territorial_area_1_id', '=', 'admin_territorial_area_1.id')
            ->join('admin_territorial_area_2', 'admin_territorial_area_3.territorial_area_2_id', '=', 'admin_territorial_area_2.id')
            ->addSelect('admin_territorial_area_1.*', 'admin_territorial_area_2.*', 'admin_territorial_area_3.*', 'admin_territorial_area_1.name as territorial_area_1_name', 'admin_territorial_area_2.name as territorial_area_2_name', 'admin_territorial_area_3.name as territorial_area_3_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_territorial_area_3.ix'));
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function territorial_area_1()
    {
        return $this->belongsTo(TerritorialArea1::class, 'territorial_area_1_id', 'id');
    }

    public function territorial_area_2()
    {
        return $this->belongsTo(TerritorialArea2::class, 'territorial_area_2_id', 'id');
    }
}