<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\AttachmentFamily;

class AttachmentFamilyService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return AttachmentFamily::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);

        if(empty($object['sizes']) && is_array($object['sizes'])) $object['sizes'] = null;
        if(! empty($object['sizes']) && is_array($object['sizes']) && count($object['sizes']) > 0) $object['sizes'] = json_encode($object['sizes']);

        AttachmentFamily::where('id', $object['id'])->update(self::builder($object));

        return AttachmentFamily::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['resource_id', 'name', 'width', 'height', 'sizes', 'quality', 'format'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['resource_id']))   throw new \Exception('You have to define a resource_id field to create a attachment family');
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a attachment family');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))      throw new \Exception('You have to define a id field to update a attachment family');
    }
}