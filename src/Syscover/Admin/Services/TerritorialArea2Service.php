<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\TerritorialArea2;

class TerritorialArea2Service
{
    public static function create($object)
    {
        TerritorialArea2Service::check($object);
        return TerritorialArea2::create(TerritorialArea2Service::builder($object));
    }

    public static function update($object)
    {
        TerritorialArea2Service::check($object);
        TerritorialArea2::where('ix', $object['ix'])->update(TerritorialArea2Service::builder($object));

        return TerritorialArea2::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $data = [];

        if($object->has('id'))                      $data['id'] = $object->get('id');
        if($object->has('country_id'))              $data['country_id'] = $object->get('country_id');
        if($object->has('territorial_area_1_id'))   $data['territorial_area_1_id'] = $object->get('territorial_area_1_id');
        if($object->has('name'))                    $data['name'] = $object->get('name');
        if($object->has('slug'))                    $data['slug'] = $object->get('slug');

        return $data;
    }

    private static function check($object)
    {
        if(empty($object['id']))                    throw new \Exception('You have to define a id field to create a territorial area 2');
        if(empty($object['country_id']))            throw new \Exception('You have to define a country_id field to create a territorial area 2');
        if(empty($object['territorial_area_1_id'])) throw new \Exception('You have to define a territorial_area_1_id field to create a territorial area 2');
        if(empty($object['name']))                  throw new \Exception('You have to define a name field to create a territorial area 2');
    }
}