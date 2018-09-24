<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Resource;

class ResourceService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return Resource::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        Resource::where('ix', $object['ix'])->update(self::builder($object));

        return Resource::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['id', 'name', 'package_id'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))            throw new \Exception('You have to define a id field to create a resource');
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a resource');
        if(empty($object['package_id']))    throw new \Exception('You have to define a package_id field to create a resource');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a resource');
    }
}