<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Action;

class ActionService
{
    public static function create($object)
    {
        ActionService::checkCreate($object);
        return Action::create(ActionService::builder($object));
    }

    public static function update($object)
    {
        ActionService::checkUpdate($object);
        Action::where('ix', $object['ix'])->update(ActionService::builder($object));

        return Action::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['id', 'name'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))     throw new \Exception('You have to define a id field to create a action');
        if(empty($object['name']))   throw new \Exception('You have to define a name field to create a action');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a action');
    }
}