<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Package;

class PackageService
{
    public static function create($object)
    {
        PackageService::check($object);
        return Package::create(PackageService::builder($object));
    }

    public static function update($object)
    {
        PackageService::check($object);
        Package::where('id', $object['id'])->update(PackageService::builder($object));

        return Package::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $data = [];

        if($object->has('id'))      $data['id'] = $object->get('id');
        if($object->has('name'))    $data['name'] = $object->get('name');
        if($object->has('root'))    $data['root'] = $object->get('root');
        if($object->has('active'))  $data['active'] = $object->get('active');
        if($object->has('sort'))    $data['sort'] = $object->get('sort');

        return $data;
    }

    private static function check($object)
    {
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a package');
        if(empty($object['root']))      throw new \Exception('You have to define a root field to create a package');
        if(! isset($object['active']))  throw new \Exception('You have to define a active field to create a package');
        if(empty($object['sort']))      throw new \Exception('You have to define a sort field to create a package');
    }
}