<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Lang;

class LangService
{
    public static function create($object)
    {
        LangService::checkCreate($object);
        return Lang::create(LangService::builder($object));
    }

    public static function update($object, $ix)
    {
        LangService::checkUpdate($object);
        Lang::where('ix', $ix)->update(LangService::builder($object));

        return Lang::find($ix);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only('id', 'name', 'icon', 'sort', 'active')->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))     throw new \Exception('You have to define a id field to create a lang');
        if(empty($object['name']))   throw new \Exception('You have to define a name field to create a lang');
        if(empty($object['sort']))   throw new \Exception('You have to define a sort field to create a lang');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix']))     throw new \Exception('You have to define a ix field to update a lang');
    }
}