<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Lang;

class LangService
{
    /**
     * @param  array    $object     contain properties of action
     * @return \Syscover\Admin\Models\Lang
     */
    public static function create($object)
    {
        return Lang::create($object);
    }

    /**
     * @param array     $object     contain properties of action
     * @return \Syscover\Admin\Models\Lang
     */
    public static function update($object)
    {
        $object = collect($object);

        Lang::where('ix', $object->get('ix'))
            ->update([
                'id'        => $object->get('id'),
                'name'      => $object->get('name'),
                'icon'      => $object->get('icon'),
                'sort'      => $object->get('sort'),
                'active'    => $object->get('active')
            ]);

        return Lang::find($object->get('ix'));
    }
}