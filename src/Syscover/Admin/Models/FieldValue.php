<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Field
 * @package Syscover\Pulsar\Models
 */

class FieldValue extends CoreModel
{
	protected $table        = 'field_value';
    protected $fillable     = ['id', 'group_id', 'name', 'field_type_id', 'field_type_name', 'data_type_id', 'data_type_name', 'required', 'sort', 'max_length', 'pattern', 'label_size', 'field_size', 'data_lang', 'data'];
    public $timestamps      = false;
    public $with            = ['resource'];

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
        return $query;
    }

    public function resource()
    {
        return $this->belongsTo(Resource::class, 'resource_id');
    }
}