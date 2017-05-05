<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class FieldResult
 * @package Syscover\Pulsar\Models
 */

class FieldResult extends CoreModel
{
	protected $table        = 'field_result';
    protected $fillable     = ['object_id', 'lang_id', 'resource_id', 'field_id', 'data_type', 'value'];
    public $timestamps      = false;
    public $with            = ['lang'];

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

    public function lang()
    {
        return $this->belongsTo(Lang::class, 'lang_id');
    }
}