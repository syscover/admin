<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Field
 * @package Syscover\Pulsar\Models
 */

class Field extends CoreModel
{
	protected $table        = 'admin_field';
    protected $fillable     = ['id', 'field_group_id', 'name', 'labels', 'field_type_id', 'field_type_name', 'data_type_id', 'data_type_name', 'required', 'sort', 'max_length', 'pattern', 'label_class', 'component_class', 'data_lang', 'data'];
    protected $casts        = [
        'labels'    => 'array',
        'data_lang' => 'array',
        'data'      => 'array'
    ];
    public $with            = ['values'];

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
        return $query->leftJoin('admin_field_group', 'admin_field.field_group_id', '=', 'admin_field_group.id')
            ->select('admin_field_group.*', 'admin_field.*', 'admin_field_group.name as field_group_name', 'admin_field.name as field_name');
    }

    public function values()
    {
        return $this->hasMany(FieldValue::class, 'field_id');
    }

    // can't include field_group in with, because will be a loop, FieldGroup has Fields in with
    // you must call this method with load property
    public function field_group()
    {
        return $this->belongsTo(FieldGroup::class, 'field_group_id');
    }

    /**
     * Overwrite deleteTranslationRecord from CoreModel to delete
     * json language field, in labels column
     * @param $id
     * @param $langId
     * @param bool $deleteLangDataRecord
     */
    public static function deleteTranslationRecord($id, $langId, $deleteLangDataRecord = true)
    {
        $field = Field::find($id);

        $labels = collect($field->labels); // get labels

        $field->labels = $labels->filter(function($value, $key) use ($langId) {
            return $value['id'] !== $langId;
        });

        $field->save(); // save values

        // set values on data_lang
        Field::deleteDataLang($langId, $id, 'id');
    }
}