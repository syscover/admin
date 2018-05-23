<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\Hash;
use Syscover\Admin\Models\User;

class UserService
{
    public static function create($object)
    {
        UserService::checkCreate($object);
        return User::create(UserService::builder($object));
    }

    public static function update($object)
    {
        UserService::checkUpdate($object);
        User::where('id', $object['id'])->update(UserService::builder($object));

        return User::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        $object = $object->only('name', 'surname', 'email', 'lang_id', 'active', 'profile_id', 'user', 'password');

        if($object->has('password'))
        {
            if($object->get('password')) $object['password'] = Hash::make($object->get('password')); else $object = $object->forget('password');
        }

        return $object->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))          throw new \Exception('You have to define a name field to create a user');
        if(empty($object['lang_id']))       throw new \Exception('You have to define a lang_id field to create a user');
        if(empty($object['email']))         throw new \Exception('You have to define a email field to create a user');
        if(empty($object['profile_id']))    throw new \Exception('You have to define a profile_id field to create a user');
        if(empty($object['user']))          throw new \Exception('You have to define a user field to create a user');
        if(empty($object['password']))      throw new \Exception('You have to define a password field to create a user');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id'])) throw new \Exception('You have to define a id field to update a user');
    }
}