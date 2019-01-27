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
    public $with            = ['permissions'];
    private static $rules   = [
        'name' => 'required|between:2,50'
    ];

    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
    }

    public function permissions()
    {
        return $this->hasMany(Permission::class, 'profile_id');
    }
}
