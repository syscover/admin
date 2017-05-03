<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class FieldGroup
 * @package Syscover\Pulsar\Models
 */

class FieldGroup extends CoreModel
{
	protected $table        = 'field_group';
    protected $fillable     = ['id', 'name', 'resource_id'];
    public $timestamps      = false;
    public $with            = ['resource'];

    private static $rules   = [
        'id'            => 'required|between:2,25|unique:action,id',
        'name'          => 'required|between:2,50',
        'resource_id'   => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query;
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}