<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Profile;

class ProfileService
{
    public static function create($object)
    {
        self::checkCreate($object);
        return Profile::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        Profile::where('id', $object['id'])->update(self::builder($object));

        return Profile::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['id', 'name'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))   throw new \Exception('You have to define a name field to create a profile');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id'])) throw new \Exception('You have to define a id field to update a profile');
    }
}