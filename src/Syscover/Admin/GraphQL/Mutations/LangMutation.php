<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Lang;
use Syscover\Admin\Services\LangService;
use Syscover\Core\Services\SQLService;

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
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminLangInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return LangService::create($args['object']);
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
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminLangInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return LangService::update($args['object']);
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
        $object = SQLService::destroyRecord($args['id'], Lang::class);

        return $object;
    }
}
