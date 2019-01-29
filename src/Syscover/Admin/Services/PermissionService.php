<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Permission;

class PermissionService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return Permission::create(self::builder($object));
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only([
                'profile_id',
                'resource_id',
                'action_id'
            ])
            ->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['profile_id']))    throw new \Exception('You have to define a profile_id field to create a permission');
        if(empty($object['resource_id']))   throw new \Exception('You have to define a resource_id field to create a permission');
        if(empty($object['action_id']))     throw new \Exception('You have to define a action_id field to create a permission');
    }
}
