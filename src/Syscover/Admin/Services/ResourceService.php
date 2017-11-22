<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Resource;

class ResourceService
{
    /**
     * @param  array    $object     contain properties of action
     * @return \Syscover\Admin\Models\Resource
     */
    public static function create($object)
    {
        return Resource::create($object);
    }

    /**
     * @param array     $object     contain properties of action
     * @return \Syscover\Admin\Models\Resource
     */
    public static function update($object)
    {
        $object = collect($object);

        Resource::where('ix', $object->get('ix'))
            ->update([
                'id'    => $object->get('id'),
                'name'  => $object->get('name')
            ]);

        return Resource::find($object->get('ix'));
    }
}