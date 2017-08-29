<?php namespace Syscover\Admin\Traits;

use Syscover\Admin\Models\Country;

trait Geolocalizable
{
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function getTerritorialArea($zone)
    {
        switch ($zone) {
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