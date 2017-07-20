<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\FieldValue;
use Syscover\Core\Services\SQLService;

class FieldValueMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminFieldValue');
    }
}

class AddFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'addFieldValue',
        'description'   => 'Add new field'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldValueInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if(isset($args['object']['id']))
        {
            $id         = $args['object']['id'];
            $counter    = null; // the id is defined by user
        }
        else
        {
            $counter    = FieldValue::where('field_id', $args['object']['field_id'])->max('counter'); // get max id from this field
            $counter++;
            $id         = $counter;
        }

        $args['object']['id'] = $id;
        $args['object']['counter'] = $counter;
        $args['object']['data_lang'] = FieldValue::addLangDataRecord($args['object']['lang_id'], $id);

        return FieldValue::create($args['object']);
    }
}

class UpdateFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'updateFieldValue',
        'description'   => 'Update field group'
    ];

    public function args()
    {
        return [
            'idOld' => [
                'name' => 'idOld',
                'type' => Type::nonNull(Type::string())
            ],
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminFieldValueInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        if($args['object']['id'])
        {
            $id         = $args['object']['id'];
            $counter    = null; // the id is defined by user

            // if change id, change id for object of all languages
            FieldValue::where('field_id', $args['object']['field_id'])
                ->where('id', $args['idOld'])
                ->update(['id' => $id]);
        }
        else
        {
            // when update value, if id is autoincrement, is not possible change id
            $id = $args['idOld'];
        }

        FieldValue::where('field_id', $args['object']['field_id'])
            ->where('id', $id)
            ->where('lang_id', $args['object']['lang_id'])
            ->update([
                'id'            => $id,
                'name'          => $args['object']['name'],
                'sort'          => $args['object']['sort'],
                'featured'      => $args['object']['featured']
            ]);

        return FieldValue::where('id', $id)
            ->where('lang_id', $args['object']['lang_id'])
            ->where('field_id', $args['object']['field_id'])
            ->first();
    }
}

class DeleteFieldValueMutation extends FieldValueMutation
{
    protected $attributes = [
        'name'          => 'deleteFieldValue',
        'description'   => 'Delete field value'
    ];

    public function args()
    {
        return [
            'field' => [ // sustituir por filtros
                'name' => 'field',
                'type' => Type::nonNull(Type::int())
            ],
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
        $object = SQLService::destroyRecord($args['id'], FieldValue::class, $args['lang']);

        return $object;
    }
}
