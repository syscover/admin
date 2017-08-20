<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Permission
 * @package Syscover\Admin\Models
 */

class Permission extends CoreModel
{
	protected $table        = 'admin_permission';
    protected $primaryKey   = 'profile_id';
    private static $rules   = [
        'profile_id'    =>  'required',
        'resource_id'   =>  'required',
        'action_id'     =>  'required'
    ];
      
    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
        
    public static function deleteRecord($profile, $resource, $action)
    {
        Permission::where('profile_id', $profile)->where('resource_id', $resource)->where('action_id', $action)->delete();
    }

    public static function deleteRecordsProfile($profile)
    {
        Permission::where('profile_id', $profile)->delete();
    }

    public static function getRecord($profile)
    {
        return Permission::where('profile_id', $profile)->get();
    }
}