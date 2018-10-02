<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class OAuthClient
 * @package Syscover\Core\Models
 */

class OAuthClient extends CoreModel
{
	protected $table        = 'oauth_clients';
    protected $primaryKey   = 'id';
    protected $fillable     = ['id', 'user_id', 'name', 'secret', 'redirect', 'personal_access_client', 'password_client', 'revoked'];
    private static $rules   = [];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}
}