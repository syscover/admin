<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\OAuthAccessToken;
use Syscover\Admin\Models\User;

class OAuthAccessTokenService
{
    public static function create($object)
    {
        self::checkCreate($object);

        $user = User::find($object['user_id']);

        return $user->createToken(
            $object['name'], $object['scopes'] ?? []
        );
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        OAuthAccessToken::where('id', $object['id'])->update(self::builder($object));

        return OAuthAccessToken::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['name'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a oauth client');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))      throw new \Exception('You have to define a id field to update a oauth client');
    }
}