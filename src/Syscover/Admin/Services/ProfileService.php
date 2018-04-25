<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Profile;

class ProfileService
{
    public static function create($object)
    {
        ProfileService::check($object);
        return Profile::create(ProfileService::builder($object));
    }

    public static function update($object)
    {
        ProfileService::check($object);
        Profile::where('id', $object['id'])->update(ProfileService::builder($object));

        return Profile::find($object['id']);
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
        if(empty($object['name'])) throw new \Exception('You have to define a name field to create a profile');
    }
}