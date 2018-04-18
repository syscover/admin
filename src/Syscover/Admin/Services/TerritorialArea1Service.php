<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Service
{
    public static function create($object)
    {
        TerritorialArea1Service::check($object);
        return TerritorialArea1::create(TerritorialArea1Service::builder($object));
    }

    public static function update($object)
    {
        TerritorialArea1Service::check($object);
        TerritorialArea1::where('ix', $object['ix'])->update(TerritorialArea1Service::builder($object));

        return TerritorialArea1::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $data = [];

        if($object->has('id'))          $data['id'] = $object->get('id');
        if($object->has('country_id'))  $data['country_id'] = $object->get('country_id');
        if($object->has('name'))        $data['name'] = $object->get('name');
        if($object->has('slug'))        $data['slug'] = $object->get('slug');

        return $data;
    }

    private static function check($object)
    {
        if(empty($object['id']))            throw new \Exception('You have to define a id field to create a territorial area 1');
        if(empty($object['country_id']))    throw new \Exception('You have to define a country_id field to create a territorial area 1');
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a territorial area 1');
    }
}