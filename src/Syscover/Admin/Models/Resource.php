<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Resource
 * @package Syscover\Admin\Models
 */

class Resource extends CoreModel
{
	protected $table        = 'resource';
    protected $fillable     = ['id', 'name', 'package_id'];
    public $incrementing    = false;
    public $timestamps      = false;
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
        return $query->join('package', 'resource.package_id', '=', 'package.id')
            ->select('package.*', 'resource.*', 'package.name as package_name', 'resource.name as resource_name');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}