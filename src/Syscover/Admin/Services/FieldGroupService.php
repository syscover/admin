<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\FieldGroup;

class FieldGroupService
{
    public static function create($object)
    {
        FieldGroupService::checkCreate($object);
        return FieldGroup::create(FieldGroupService::builder($object));
    }

    public static function update($object)
    {
        FieldGroupService::checkUpdate($object);
        FieldGroup::where('id', $object['id'])->update(FieldGroupService::builder($object));

        return FieldGroup::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['name', 'resource_id'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a field group');
        if(empty($object['resource_id']))   throw new \Exception('You have to define a resource_id field to create a field group');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))    throw new \Exception('You have to define a id field to update a field group');
    }
}