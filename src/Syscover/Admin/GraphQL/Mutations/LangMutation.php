<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Lang;

class LangMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminLang');
    }
}

class AddLangMutation extends LangMutation
{
    protected $attributes = [
        'name'          => 'addLang',
        'description'   => 'Add new lang'
    ];

    public function args()
    {
        return [
            'lang' => [
                'name' => 'lang',
                'type' => Type::nonNull(GraphQL::type('AdminLangInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Lang::create($args['lang']);
    }
}

class UpdateLangMutation extends LangMutation
{
    protected $attributes = [
        'name' => 'updateLang',
        'description' => 'Update lang'
    ];

    public function args()
    {
        return [
            'idOld' => [
                'name' => 'idOld',
                'type' => Type::nonNull(Type::string())
            ],
            'lang' => [
                'name' => 'lang',
                'type' => Type::nonNull(GraphQL::type('AdminLangInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        Lang::where('id', $args['idOld'])
            ->update($args['lang']);

        return Lang::find($args['lang']['id']);
    }
}

class DeleteLangMutation extends LangMutation
{
    protected $attributes = [
        'name' => 'deleteLang',
        'description' => 'Delete lang'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = Lang::builder()->find($args['id']);
        $object->delete();

        return $object;
    }
}
