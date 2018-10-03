<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class OAuthAccessToken
 * @package Syscover\Core\Models
 */

class OAuthAccessToken extends CoreModel
{
	protected $table        = 'oauth_access_tokens';
    protected $primaryKey   = 'id';
    protected $fillable     = ['id', 'user_id', 'client_id', 'name', 'scopes', 'revoked'];
    private static $rules   = [];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}
}