<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;
use Syscover\Admin\Traits\Translatable;

/**
 * Class FieldValue
 * @package Syscover\Pulsar\Models
 */

class FieldValue extends CoreModel
{
    use Translatable;

	protected $table        = 'admin_field_value';
    protected $fillable     = ['id', 'lang_id', 'field_id', 'counter', 'sort', 'featured', 'name', 'data_lang', 'data'];
    public $incrementing    = false;
    protected $casts        = [
        'featured'  => 'boolean',
        'data_lang' => 'array',
        'data'      => 'array'
    ];
    public $with            = ['lang'];

    private static $rules   = [
        'name'          => 'required|between:2,50',
        'field_id'      => 'required'
    ];

    public static function validate($data, $specialRules = [])
    {
        return Validator::make($data, static::$rules);
	}

    public function scopeBuilder($query)
    {
        return $query->join('admin_field', 'admin_field_value.field_id', '=', 'admin_field.id')
            ->select('admin_field.*', 'admin_field_value.*', 'admin_field.name as field_name', 'admin_field_value.name as field_value_name');
    }
}