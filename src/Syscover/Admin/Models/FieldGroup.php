<?php namespace Syscover\Admin\Models;

use Illuminate\Support\Facades\DB;
use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class FieldGroup
 * @package Syscover\Admin\Models
 */

class FieldGroup extends CoreModel
{
	protected $table        = 'admin_field_group';
    protected $fillable     = ['id', 'name', 'resource_id'];
    public $with            = ['resource', 'fields'];

    private static $rules   = [
        'name'          => 'required|between:2,50',
        'resource_id'   => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query
            ->join('admin_resource', 'admin_field_group.resource_id', '=', 'admin_resource.id')
            ->addSelect('admin_field_group.*', 'admin_resource.name as admin_resource_name', 'admin_field_group.name as admin_field_group_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_field_group.id'));
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id', 'id');
    }

    public function fields()
    {
        return $this->hasMany(Field::class, 'field_group_id');
    }
}
