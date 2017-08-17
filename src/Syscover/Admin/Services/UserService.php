<?php namespace Syscover\Admin\Services;

use Illuminate\Support\Facades\Hash;
use Syscover\Admin\Models\User;

class UserService
{
    /**
     * @param  array    $object     contain properties of user
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create($object)
    {
        $object['password'] = Hash::make($object['password']);

        return  User::create($object);
    }

    /**
     * @param array     $object     contain properties of user
     * @param int       $id         old id of section
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object, $id)
    {
        $object = collect($object);

        User::where('id', $id)->update([
            'name'          => $object->get('name'),
            'surname'       => $object->get('surname'),
            'email'         => $object->get('email'),
            'lang_id'       => $object->get('lang_id'),
            'profile_id'    => $object->get('profile_id'),
            'access'        => $object->get('access'),
            'user'          => $object->get('user'),
            'password'      => Hash::make($object->get('password'))
        ]);

        return User::find($id);
    }
}