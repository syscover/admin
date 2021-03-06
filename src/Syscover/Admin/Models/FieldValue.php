<?php namespace Syscover\Admin\Models;

use Illuminate\Support\Facades\DB;
use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;
use Syscover\Admin\Traits\Langable;

/**
 * Class FieldValue
 * @package Syscover\Admin\Models
 */

class FieldValue extends CoreModel
{
    use Langable;

	protected $table        = 'admin_field_value';
    protected $primaryKey   = 'ix';
    protected $fillable     = ['ix', 'id', 'lang_id', 'field_id', 'counter', 'sort', 'featured', 'name', 'data_lang', 'data'];
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
        return $query
            ->join('admin_field', 'admin_field_value.field_id', '=', 'admin_field.id')
            ->addSelect('admin_field.*', 'admin_field_value.*', 'admin_field.name as admin_field_name', 'admin_field_value.name as admin_field_value_name');
    }

    public function scopeCalculateFoundRows($query)
    {
        return $query->select(DB::raw('SQL_CALC_FOUND_ROWS admin_field_value.ix'));
    }
}
