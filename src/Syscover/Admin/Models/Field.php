<?php namespace Syscover\Admin\Models;

use Syscover\Core\Models\CoreModel;
use Illuminate\Support\Facades\Validator;

/**
 * Class Field
 * @package Syscover\Pulsar\Models
 */

class Field extends CoreModel
{
	protected $table        = 'field';
    protected $fillable     = ['id', 'field_group_id', 'name', 'labels', 'field_type_id', 'field_type_name', 'data_type_id', 'data_type_name', 'required', 'sort', 'max_length', 'pattern', 'label_class', 'component_class', 'data_lang', 'data'];
    public $timestamps      = false;
    protected $casts        = [
        'labels'    => 'array',
        'data_lang' => 'array',
        'data'      => 'array'
    ];
    public $with            = ['group', 'values'];

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

    public function values()
    {
        return $this->hasMany(FieldValue::class, 'field_id');
    }

    public function group()
    {
        return $this->belongsTo(Resource::class, 'group_id');
    }

    /**
     * Overwrite deleteTranslationRecord from CoreModel to delete
     * json language field, in labels column
     * @param $id
     * @param $lang
     * @param bool $deleteLangDataRecord
     */
    public static function deleteTranslationRecord($id, $lang, $deleteLangDataRecord = true)
    {
        $field = Field::find($id);

        $labels = collect($field->labels); // get labels

        $field->labels = $labels->filter(function($value, $key) use ($lang) {
            return $value['id'] !== $lang;
        });

        $field->save(); // save values

        // set values on data_lang
        Field::deleteLangDataRecord($id, $lang);
    }
}