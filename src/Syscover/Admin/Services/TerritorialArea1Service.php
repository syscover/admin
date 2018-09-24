<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Service
{
    public static function create($object)
    {
        self::checkCreate($object);
        return TerritorialArea1::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        TerritorialArea1::where('ix', $object['ix'])->update(self::builder($object));

        return TerritorialArea1::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['id', 'country_id', 'name', 'slug'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))            throw new \Exception('You have to define a id field to create a territorial area 1');
        if(empty($object['country_id']))    throw new \Exception('You have to define a country_id field to create a territorial area 1');
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a territorial area 1');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a territorial area 1');
    }
}