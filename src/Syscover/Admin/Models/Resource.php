<?php namespace Syscover\Admin\Models;

use Illuminate\Support\Facades\DB;
use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Resource
 * @package Syscover\Admin\Models
 */

class Resource extends CoreModel
{
	protected $table        = 'admin_resource';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'name', 'package_id'];
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
            ->addSelect('admin_package.*', 'admin_resource.*', 'admin_package.name as admin_package_name', 'admin_resource.name as admin_resource_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_resource.ix'));
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}