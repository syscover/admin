<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Syscover\Admin\Traits\Translatable;

/**
 * Class Country
 * @package Syscover\Admin\Models
 */

class Country extends CoreModel
{
    use Translatable;

    protected $table        = 'admin_country';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix' ,'id', 'lang_id', 'name', 'slug', 'sort', 'prefix', 'territorial_area_1', 'territorial_area_2', 'territorial_area_3', 'zones', 'latitude', 'longitude', 'zoom', 'data_lang'];
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

    public function territorial_areas_1()
    {
        return $this->hasMany(TerritorialArea1::class, 'country_id', 'id')->orderBy('name', 'asc');
    }

    public function territorial_areas_2()
    {
        return $this->hasMany(TerritorialArea2::class, 'country_id', 'id')->orderBy('name', 'asc');
    }

    public function territorial_areas_3()
    {
        return $this->hasMany(TerritorialArea3::class, 'country_id', 'id')->orderBy('name', 'asc');
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
