<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Field;

class FieldService
{
    public static function create($object)
    {
        FieldService::checkCreate($object);

        if(empty($object['id']))
        {
            if(! empty($object['label'])) $object['labels'] = [['id' => $object['lang_id'], 'value' => $object['label']]];

            $object['data_lang'] = Field::addDataLang($object['lang_id']);

            return Field::create(FieldService::builder($object));
        }
        else
        {
            $object     = collect($object);

            // get object to update data and data_lang field
            $field      = Field::find($object->get('id'));

            // get values
            $labels     = $field->labels;
            $dataLang   = $field->data_lang;

            // set values
            $labels[]   = [
                'id'    => $object->get('lang_id'),
                'value' => $object->get('label')
            ];
            $dataLang[] = $object->get('lang_id');

            // update values
            $field->labels      = $labels;
            $field->data_lang   = $dataLang;

            $field->save();

            return $field;
        }
    }

    public static function update($object)
    {
        FieldService::checkUpdate($object);

        // set label field
        if(! empty($object['label']))
        {
            if(empty($object['lang_id']))   throw new \Exception('You have to define a lang_id field to update a label field');

            $field = Field::find($object['id']);

            // set label
            $labels = collect($field->labels);
            $labels->transform(function($obj) use ($object) {
                if($obj['id'] === $object['lang_id']) $obj['value'] = $object['label'];
                return $obj;
            });

            $object['labels'] = json_encode($labels);
        }

        Field::where('id', $object['id'])->update(FieldService::builder($object));

        return Field::find($object['id']);
    }

    private static function builder($object)
    {
        $object = collect($object);

        if($object->has('field_type_id'))   $object['field_type_name'] = collect(config('pulsar-admin.field_types'))->where('id', $object->get('field_type_id'))->first()->name;
        if($object->has('data_type_id'))    $object['data_type_name'] = collect(config('pulsar-admin.data_types'))->where('id', $object->get('data_type_id'))->first()->name;

        return $object->only(['field_group_id', 'name', 'labels', 'field_type_id', 'field_type_name', 'data_type_id', 'data_type_name', 'required', 'sort', 'max_length', 'pattern', 'label_class', 'component_class', 'data_lang', 'data'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['field_group_id']))    throw new \Exception('You have to define a field_group_id field to create a field');
        if(empty($object['lang_id']))           throw new \Exception('You have to define a lang_id field to create a field');
        if(empty($object['label']))             throw new \Exception('You have to define a label field to create a field');
        if(empty($object['field_type_id']))     throw new \Exception('You have to define a field_type_id field to create a field');
        if(empty($object['data_type_id']))      throw new \Exception('You have to define a data_type_id field to create a field');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['id'])) throw new \Exception('You have to define a id field to update a field');
    }
}