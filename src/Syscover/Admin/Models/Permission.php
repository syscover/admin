<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Permission
 * @package Syscover\Admin\Models
 */

class Permission extends CoreModel
{
	protected $table        = 'permission';
    protected $primaryKey   = 'profile_id';
    public $timestamps      = false;
    private static $rules   = [
        'profile_id_009'    =>  'required',
        'resource_id_009'   =>  'required',
        'action_id_009'     =>  'required'
    ];
      
    public static function validate($data)
    {
        return Validator::make($data, static::$rules);
	}
        
    public static function deleteRecord($profile, $resource, $action)
    {
        Permission::where('profile_id_009', $profile)->where('resource_id_009', $resource)->where('action_id_009', $action)->delete();
    }

    public static function deleteRecordsProfile($profile)
    {
        Permission::where('profile_id_009', $profile)->delete();
    }

    public static function getRecord($profile)
    {
        return Permission::where('profile_id_009', $profile)->get();
    }
}