<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;
use Syscover\Admin\Traits\Translatable;

/**
 * Class Country
 * @package Syscover\Admin\Models
 */

class Country extends CoreModel
{
    use Translatable;

    protected $table        = 'country';
    protected $fillable     = ['id', 'lang_id', 'name', 'sort', 'prefix', 'territorial_area_1', 'territorial_area_2', 'territorial_area_3', 'data_lang'];
    public $incrementing    = false;
    public $timestamps      = false;
    protected $casts        = [
        'data_lang' => 'array'
    ];
    public $with            = ['lang'];

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
        return $query;
    }
}