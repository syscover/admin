<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\FieldValue;

class FieldValueService
{
    /**
     * @param  array    $object     contain properties of action
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create($object)
    {
        if(isset($object['id']))
        {
            $id         = $object['id'];
            $counter    = null; // the id is defined by user
        }
        else
        {
            $counter    = FieldValue::where('field_id', $object['field_id'])->max('counter'); // get max id from this field
            $counter++;
            $id         = $counter;
        }

        $object['id']           = $id;
        $object['counter']      = $counter;
        $object['data_lang']    = FieldValue::addDataLang($object['lang_id'], $object['id'], ['field_id' => $object['field_id']]);

        return FieldValue::create($object);
    }

    /**
     * @param array     $object     contain properties of action
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object)
    {
        $object = collect($object);

        $fieldValue = FieldValue::find($object['ix']);

        // change id for object of all languages
        FieldValue::where('field_id', $object->get('field_id'))
            ->where('id', $fieldValue->id)
            ->update(['id' => $object->get('id')]);


        FieldValue::where('field_id', $object->get('field_id'))
            ->where('id', $fieldValue->id)
            ->where('lang_id', $object->get('lang_id'))
            ->update([
                'name'          => $object->get('name'),
                'sort'          => $object->get('sort'),
                'featured'      => $object->get('featured')
            ]);

        return FieldValue::where('id', $object->get('id'))
            ->where('lang_id', $object->get('lang_id'))
            ->where('field_id', $object->get('field_id'))
            ->first();
    }
}