<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea1
 * @package Syscover\Admin\Models
 */

class TerritorialArea1 extends CoreModel
{
    protected $table        = 'territorial_area_1';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'      => 'required|between:1,6|unique:001_003_territorial_area_1,id_003',
        'name'    => 'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule'])   static::$rules['id'] = 'required|between:1,6';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('country', 'territorial_area_1.country_id', '=', 'country.id')
            ->select('country.*','territorial_area_1.*','country.name as country_name', 'territorial_area_1.name as territorial_area_1_name');
    }

    public function getTerritorialAreas2()
    {
        return $this->hasMany('Syscover\Pulsar\Models\TerritorialArea2', 'territorial_area_1_id_004');
    }

    public function addToGetIndexRecords($request, $parameters)
    {
        $query = $this->builder();

        if(isset($parameters['country'])) $query->where('country_id_003', $parameters['country']);
        if(isset($parameters['lang']))
            $query->where('lang_id_002', $parameters['lang']);
        else
            $query->where('lang_id_002', base_lang()->id_001);

        return $query;
    }

    public static function customCount($request, $parameters)
    {
        $query = TerritorialArea1::builder();

        if(isset($parameters['country'])) $query->where('country_id_003', $parameters['country']);
        if(isset($parameters['lang']))
            $query->where('lang_id_002', $parameters['lang']);
        else
            $query->where('lang_id_002', base_lang()->id_001);

        return $query;
    }

    public static function getTerritorialAreas1FromCountry($country)
    {
        return TerritorialArea1::where('country_id_003', $country)
            ->orderBy('name_003', 'asc')
            ->get();
    }
}