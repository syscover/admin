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

    /**
     * Function to add lang record from json field
     *
     * @access	public
     * @param   int $id
     * @param   string $lang
     * @param   string $fieldId
     * @return	string
     */
    public static function addLangDataRecord($lang, $fieldId, $id = null)
    {
        // if id is equal to null, is a new object
        if($id === null)
        {
            $json[] = $lang;
        }
        else
        {
            $instance   = new static;
            $object     = $instance::where('id', $id)
                ->where('field_id', $fieldId)
                ->first();

            if($object !== null)
            {
                $json = $object->data_lang; // get data_lang from object
                $json[] = $lang; // add new language

                // updates all objects with new language variables
                $instance::where($object->table . '.' . $instance->getKeyName(), $id)
                    ->where('field_id', $fieldId)
                    ->update([
                        'data_lang' => json_encode($json)
                    ]);
            }
            else
            {
                $json[] = $lang;
            }
        }

        return $json;
    }
}