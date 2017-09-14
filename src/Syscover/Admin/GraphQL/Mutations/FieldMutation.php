<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Field;
use Syscover\Core\Services\SQLService;

class FieldMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminField');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldInput'))
            ],
        ];
    }
}

class AddFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'addField',
        'description'   => 'Add new field'
    ];

    public function resolve($root, $args)
    {
        // create new lang
        if(! empty($args['object']['id']))
        {
            // get object to update data and data_lang field
            $field = Field::find($args['object']['id']);

            // get values
            $dataLang   = $field->data_lang;
            $labels     = $field->labels;

            // set values
            $dataLang[] = $args['object']['lang_id'];
            $labels[] = [
                'id'  => $args['object']['lang_id'],
                'value' => $args['object']['label']
            ];

            // update values
            $field->data_lang = $dataLang;
            $field->labels = $labels;

            $field->save();

            return $field;
        }

        // create new object
        // get file type name
        $args['object']['field_type_name'] = collect(config('pulsar-admin.field_types'))
            ->where('id', $args['object']['field_type_id'])
            ->first()
            ->name;

        // get data type name
        $args['object']['data_type_name'] = collect(config('pulsar-admin.data_types'))
            ->where('id', $args['object']['data_type_id'])
            ->first()
            ->name;

        // set label
        $args['object']['labels'] = [[
            'id' => $args['object']['lang_id'],
            'value' => $args['object']['label']
        ]];

        $args['object']['data_lang'] = Field::addLangDataRecord($args['object']['lang_id']);

        return Field::create($args['object']);
    }
}

class UpdateFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'updateField',
        'description'   => 'Update field group'
    ];

    public function resolve($root, $args)
    {
        $field = Field::find($args['object']['id']);

        if(base_lang() == $args['object']['lang_id'])
        {
            // get file type name
            $args['object']['field_type_name'] = collect(config('pulsar-admin.field_types'))
                ->where('id', $args['object']['field_type_id'])
                ->first()
                ->name;

            // get data type name
            $args['object']['data_type_name'] = collect(config('pulsar-admin.data_types'))
                ->where('id', $args['object']['data_type_id'])
                ->first()
                ->name;

            // set label
            $labels = collect($field->labels);
            $labels->transform(function($obj) use ($args) {
                if($obj['id'] === $args['object']['lang_id'])
                {
                    $obj['value'] = $args['object']['label'];
                }
                return $obj;
            });

            // save field object
            Field::where('id', $args['object']['id'])
                ->update([
                    'field_group_id'    => $args['object']['field_group_id'],
                    'name'              => $args['object']['name'],
                    'labels'            => json_encode($labels),
                    'field_type_id'     => $args['object']['field_type_id'],
                    'field_type_name'   => $args['object']['field_type_name'],
                    'data_type_id'      => $args['object']['data_type_id'],
                    'data_type_name'    => $args['object']['data_type_name'],
                    'required'          => $args['object']['required'],
                    'sort'              => $args['object']['sort'],
                    'max_length'        => $args['object']['max_length'],
                    'pattern'           => $args['object']['pattern'],
                    'label_class'       => $args['object']['label_class'],
                    'component_class'   => $args['object']['component_class']
                ]);

            return Field::find($args['object']['id']);
        }
        else
        {
            // set label
            $labels = collect($field->labels);
            $labels->transform(function($obj) use ($args) {
                if($obj['id'] === $args['object']['lang_id'])
                {
                    $obj['value'] = $args['object']['label'];
                }
                return $obj;
            });

            Field::where('id', $args['object']['id'])
                ->update(['labels' => $labels]);
        }
    }
}

class DeleteFieldMutation extends FieldMutation
{
    protected $attributes = [
        'name'          => 'deleteField',
        'description'   => 'Delete field group'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ],
            'lang' => [
                'name' => 'lang',
                'type' => Type::string()
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Field::class, isset($args['lang']) ? $args['lang'] : null);

        return $object;
    }
}
