<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Country
 * @package Syscover\Admin\Models
 */

class Country extends CoreModel
{
    protected $table        = 'country';
    public $incrementing    = false;
    public $timestamps      = false;
    private static $rules   = [
        'id'                => 'required|alpha|size:2|unique:001_country,id',
        'name'              => 'required|between:2,100',
        'sort'              => 'min:0|numeric',
        'prefix'            => 'between:1,5',
        'territorialArea1'  => 'between:0,50',
        'territorialArea2'  => 'between:0,50',
        'territorialArea3'  => 'between:0,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule'])   static::$rules['id'] = 'required|alpha|size:2';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query
            ->join('lang', 'country.lang_id', '=', 'lang.id')
            ->select('lang.*', 'country.*', 'country.name as country_name', 'lang.name as lang_name');
    }
}