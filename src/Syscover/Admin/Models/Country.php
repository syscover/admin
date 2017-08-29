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

    protected $table        = 'admin_country';
    protected $fillable     = ['id', 'lang_id', 'name', 'sort', 'prefix', 'territorial_area_1', 'territorial_area_2', 'territorial_area_3', 'zones', 'data_lang'];
    public $incrementing    = false;
    protected $casts        = [
        'zones'     => 'array',
        'data_lang' => 'array'
    ];
    public $with            = [
        'lang',
        'territorial_areas_1',
        'territorial_areas_2',
        'territorial_areas_3'
    ];

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

    public function territorial_areas_1()
    {
        return $this->hasMany(TerritorialArea1::class, 'country_id');
    }

    public function territorial_areas_2()
    {
        return $this->hasMany(TerritorialArea2::class, 'country_id');
    }

    public function territorial_areas_3()
    {
        return $this->hasMany(TerritorialArea3::class, 'country_id');
    }

    public function getTerritorialAreaName($zone)
    {
        switch ($zone) {
            case 'territorial_areas_1':
                return $this->{'territorial_area_1'};
            case 'territorial_areas_2':
                return $this->{'territorial_area_2'};
            case 'territorial_areas_3':
                return $this->{'territorial_area_3'};
            default;
                return null;
        }
    }
}