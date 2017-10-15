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

        $object['id']       = $id;
        $object['counter']  = $counter;
        $object['data_lang'] = FieldValue::addLangDataRecord($object['lang_id'], $object['field_id'], $id);

        return FieldValue::create($object);
    }

    /**
     * @param array     $object     contain properties of action
     * @param int       $id         old id of section
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object, $id)
    {
        $object = collect($object);

        if($object->has('id'))
        {
            // if change id, change id for object of all languages
            FieldValue::where('field_id', $object->get('field_id'))
                ->where('id', $id)
                ->update(['id' => $object->get('id')]);

            $id = $object->get('id');
        }

        FieldValue::where('field_id', $object->get('field_id'))
            ->where('id', $id)
            ->where('lang_id', $object->get('lang_id'))
            ->update([
                'id'            => $id,
                'name'          => $object->get('name'),
                'sort'          => $object->get('sort'),
                'featured'      => $object->get('featured')
            ]);

        return FieldValue::where('id', $id)
            ->where('lang_id', $object->get('lang_id'))
            ->where('field_id', $object->get('field_id'))
            ->first();
    }
}