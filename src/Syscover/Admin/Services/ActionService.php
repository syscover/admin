<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Action;

class ActionService
{
    public static function create($object)
    {
        ActionService::check($object);
        return Action::create(ActionService::builder($object));
    }

    public static function update($object)
    {
        ActionService::check($object);
        Action::where('ix', $object['ix'])->update(ActionService::builder($object));

        return Action::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $data = [];

        if($object->has('id'))      $data['id'] = $object->get('id');
        if($object->has('name'))    $data['name'] = $object->get('name');

        return $data;
    }

    private static function check($object)
    {
        if(empty($object['id']))     throw new \Exception('You have to define a id field to create a action');
        if(empty($object['name']))   throw new \Exception('You have to define a name field to create a action');
    }
}