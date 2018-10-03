<?php namespace Syscover\Admin\Services;

use Laravel\Passport\ClientRepository;
use Syscover\Admin\Models\OAuthClient;

class OAuthAccessTokenService
{
    public static function create($object)
    {
        self::checkCreate($object);

        $clients = new ClientRepository();

        return $clients->create(
                $object['user_id'],
                $object['name'],
                $object['redirect']
            )->makeVisible('secret');
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        OAuthClient::where('id', $object['id'])->update(self::builder($object));

        return OAuthClient::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only(['name', 'redirect'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['user_id']))   throw new \Exception('You have to define a user_id field to create a oauth client');
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a oauth client');
        if(empty($object['redirect']))  throw new \Exception('You have to define a redirect field to create a oauth client');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id']))      throw new \Exception('You have to define a id field to update a oauth client');
    }
}