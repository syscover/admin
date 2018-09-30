<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\AttachmentMime;

class AttachmentMimeService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return AttachmentMime::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);

        AttachmentMime::where('id', $object['id'])->update(self::builder($object));

        return AttachmentMime::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['resource_id', 'mime'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['resource_id']))   throw new \Exception('You have to define a resource_id field to create a attachment mime');
        if(empty($object['mime']))          throw new \Exception('You have to define a mime field to create a attachment mime');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id'])) throw new \Exception('You have to define a id field to update a attachment mime');
    }
}