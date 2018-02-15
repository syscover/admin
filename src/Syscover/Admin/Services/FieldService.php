<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Field;

class FieldService
{
    /**
     * @param  array    $object     contain properties of action
     * @return \Syscover\Admin\Models\Field
     * @throws \Exception
     */
    public static function create($object)
    {
        if(empty($object['lang_id']))   throw new \Exception('You have to define a lang_id field to create a field');

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

    /**
     * @param array $object     contain properties of action
     * @return \Syscover\Admin\Models\Field
     * @throws \Exception
     */
    public static function update($object)
    {
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
        $data = [];

        if($object->has('field_group_id'))  $data['field_group_id'] = $object->get('field_group_id');
        if($object->has('name'))            $data['name'] = $object->get('name');
        if($object->has('labels'))          $data['labels'] = $object->get('labels');
        if($object->has('field_type_id'))   $data['field_type_id'] = $object->get('field_type_id');
        if($object->has('field_type_id'))   $data['field_type_name'] = collect(config('pulsar-admin.field_types'))->where('id', $object->get('field_type_id'))->first()->name;
        if($object->has('data_type_id'))    $data['data_type_id'] = $object->get('data_type_id');
        if($object->has('data_type_id'))    $data['data_type_name'] = collect(config('pulsar-admin.data_types'))->where('id', $object->get('data_type_id'))->first()->name;
        if($object->has('required'))        $data['required'] = $object->get('required');
        if($object->has('sort'))            $data['sort'] = $object->get('sort');
        if($object->has('max_length'))      $data['max_length'] = $object->get('max_length');
        if($object->has('pattern'))         $data['pattern'] = $object->get('pattern');
        if($object->has('label_class'))     $data['label_class'] = $object->get('label_class');
        if($object->has('component_class')) $data['component_class'] = $object->get('component_class');
        if($object->has('data_lang'))       $data['data_lang'] = $object->get('data_lang');
        if($object->has('data'))            $data['data'] = $object->get('data');

        return $data;
    }
}