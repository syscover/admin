<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\FieldValue;

class FieldValueService
{
    public static function create($object)
    {
        self::checkCreate($object);

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
        $object['data_lang']    = FieldValue::getDataLang($object['lang_id'], $object['id'], ['field_id' => $object['field_id']]);

        return FieldValue::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        FieldValue::where('id', $object['id'])->where('field_id', $object['field_id'])->update(self::builder($object, ['id']));
        FieldValue::where('ix', $object['ix'])->update(self::builder($object));

        return FieldValue::find($object['ix']);
    }

    private static function builder($object, $filterKeys = null)
    {
        $object = collect($object);
        if($filterKeys) return $object->only($filterKeys)->toArray();

        return $object->only(['id', 'lang_id', 'field_id', 'counter', 'sort', 'featured', 'name', 'data_lang', 'data'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['lang_id']))   throw new \Exception('You have to define a lang_id field to create a field value');
        if(empty($object['field_id']))  throw new \Exception('You have to define a field_id field to create a field value');
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a field value');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix']))        throw new \Exception('You have to define a ix field to update a field value');
        if(empty($object['id']))        throw new \Exception('You have to define a id field to update a field value');
        if(empty($object['field_id']))  throw new \Exception('You have to define a field_id field to update a field value');
    }
}
