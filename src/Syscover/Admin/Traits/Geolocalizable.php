<?php namespace Syscover\Admin\Traits;

use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\TerritorialArea1;
use Syscover\Admin\Models\TerritorialArea2;
use Syscover\Admin\Models\TerritorialArea3;

trait Geolocalizable
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function countries()
    {
        return $this->hasMany(Country::class, 'country_id', 'id');
    }

    public function territorial_area_1()
    {
        return $this->hasOne(TerritorialArea1::class, 'id', 'territorial_area_1_id');
    }

    public function territorial_area_2()
    {
        return $this->hasOne(TerritorialArea2::class, 'id', 'territorial_area_2_id');
    }

    public function territorial_area_3()
    {
        return $this->hasOne(TerritorialArea3::class, 'id', 'territorial_area_3_id');
    }

    public function getTerritorialArea($zone)
    {
        switch ($zone)
        {
            case 'territorial_areas_1':
                return $this->{'territorial_area_1_id'};
            case 'territorial_areas_2':
                return $this->{'territorial_area_2_id'};
            case 'territorial_areas_3':
                return $this->{'territorial_area_3_id'};
            default;
                return null;
        }
    }
}
