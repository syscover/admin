<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Lang;

class LangService
{
    public static function create($object)
    {
        LangService::check($object);
        return Lang::create(LangService::builder($object));
    }

    public static function update($object, $ix)
    {
        LangService::check($object);
        Lang::where('ix', $ix)->update(LangService::builder($object));

        return Lang::find($ix);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $data = [];

        if($object->has('id'))      $data['id'] = $object->get('id');
        if($object->has('name'))    $data['name'] = $object->get('name');
        if($object->has('icon'))    $data['icon'] = $object->get('icon');
        if($object->has('sort'))    $data['sort'] = $object->get('sort');
        if($object->has('active'))  $data['active'] = $object->get('active');

        return $data;
    }

    private static function check($object)
    {
        if(empty($object['id']))     throw new \Exception('You have to define a id field to create a lang');
        if(empty($object['name']))   throw new \Exception('You have to define a name field to create a lang');
        if(empty($object['sort']))   throw new \Exception('You have to define a sort field to create a lang');
    }
}