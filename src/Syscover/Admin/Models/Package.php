<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Package
 * @package Syscover\Admin\Models
 */

class Package extends CoreModel
{
	protected $table        = 'admin_package';
    protected $fillable     = ['id', 'name', 'root', 'active', 'sort'];
    protected $casts        = [
        'active'    => 'boolean'
    ];

    private static $rules   = [
        'name'    =>  'required|between:2,50',
        'folder'  =>  'required|between:2,50'
    ];
        
    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query;
    }
}
