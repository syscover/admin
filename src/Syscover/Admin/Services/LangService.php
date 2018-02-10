<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Lang;

class LangService
{
    /**
     * @param   array   $object     contain properties of action
     * @return  \Syscover\Admin\Models\Lang
     */
    public static function create($object)
    {
        return Lang::create(LangService::builder($object));
    }

    /**
     * @param   array   $object     contain properties of action
     * @param   $ix
     * @return  \Syscover\Admin\Models\Lang
     */
    public static function update($object, $ix)
    {
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
}