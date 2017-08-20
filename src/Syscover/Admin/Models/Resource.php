<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Resource
 * @package Syscover\Admin\Models
 */

class Resource extends CoreModel
{
	protected $table        = 'admin_resource';
    protected $fillable     = ['id', 'name', 'package_id'];
    public $incrementing    = false;
    public $with            = ['package'];

    private static $rules   = [
        'id'        =>  'required|between:2,30|unique:001_007_resource,id_007',
        'package'   =>  'not_in:null',
        'name'      =>  'required|between:2,50'
    ];

    public static function validate($data, $specialRules = [])
    {
        if(isset($specialRules['idRule']) && $specialRules['idRule']) static::$rules['id'] = 'required|between:2,30';

        return Validator::make($data, static::$rules);
    }

    public function scopeBuilder($query)
    {
        return $query->join('admin_package', 'admin_resource.package_id', '=', 'admin_package.id')
            ->select('admin_package.*', 'admin_resource.*', 'admin_package.name as package_name', 'admin_resource.name as resource_name');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}