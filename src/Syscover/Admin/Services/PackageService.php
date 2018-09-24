<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Package;

class PackageService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return Package::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        Package::where('id', $object['id'])->update(self::builder($object));

        return Package::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['name', 'root', 'active', 'sort'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a package');
        if(empty($object['root']))      throw new \Exception('You have to define a root field to create a package');
        if(empty($object['sort']))      throw new \Exception('You have to define a sort field to create a package');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))      throw new \Exception('You have to define a id field to update a package');
    }
}