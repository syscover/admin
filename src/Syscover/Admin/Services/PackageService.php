<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Package;

class PackageService
{
    public static function create($object)
    {
        PackageService::checkCreate($object);
        return Package::create(PackageService::builder($object));
    }

    public static function update($object)
    {
        PackageService::checkUpdate($object);
        Package::where('id', $object['id'])->update(PackageService::builder($object));

        return Package::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only('name', 'root', 'active', 'sort')->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a package');
        if(empty($object['root']))      throw new \Exception('You have to define a root field to create a package');
        if(! isset($object['active']))  throw new \Exception('You have to define a active field to create a package');
        if(empty($object['sort']))      throw new \Exception('You have to define a sort field to create a package');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))      throw new \Exception('You have to define a id field to update a package');
    }
}