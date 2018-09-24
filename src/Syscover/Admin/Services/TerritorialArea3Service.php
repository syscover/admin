<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\TerritorialArea3;

class TerritorialArea3Service
{
    public static function create($object)
    {
        self::checkCreate($object);
        return TerritorialArea3::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        TerritorialArea3::where('ix', $object['ix'])->update(self::builder($object));

        return TerritorialArea3::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['id', 'country_id', 'name', 'territorial_area_1_id', 'territorial_area_2_id', 'slug'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))                    throw new \Exception('You have to define a id field to create a territorial area 3');
        if(empty($object['country_id']))            throw new \Exception('You have to define a country_id field to create a territorial area 3');
        if(empty($object['territorial_area_1_id'])) throw new \Exception('You have to define a territorial_area_1_id field to create a territorial area 3');
        if(empty($object['territorial_area_2_id'])) throw new \Exception('You have to define a territorial_area_2_id field to create a territorial area 3');
        if(empty($object['name']))                  throw new \Exception('You have to define a name field to create a territorial area 3');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a territorial area 3');
    }
}