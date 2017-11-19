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

        Resource::where('id', $object->get('id'))
            ->update([
                'object_id' => $object->get('object_id'),
                'name'      => $object->get('name')
            ]);

        return Resource::find($object->get('id'));
    }
}