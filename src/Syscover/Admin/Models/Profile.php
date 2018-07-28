<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Profile
 * @package Syscover\Admin\Models
 */

class Profile extends CoreModel
{
    protected $table        = 'admin_profile';
    protected $fillable     = ['name'];

    private static $rules   = [
        'name' => 'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }
}