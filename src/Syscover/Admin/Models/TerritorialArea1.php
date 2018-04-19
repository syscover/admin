<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class TerritorialArea1
 * @package Syscover\Admin\Models
 */

class TerritorialArea1 extends CoreModel
{
    protected $table        = 'admin_territorial_area_1';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'country_id', 'name', 'slug'];
    public $with            = ['country', 'territorialAreas2'];

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
        return $query;
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function territorialAreas2()
    {
        return $this->hasMany(TerritorialArea2::class, 'territorial_area_1_id');
    }
}