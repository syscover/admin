<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\Services\SQLService;

class ActionPaginationType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'ActionPaginationType',
        'description'   => 'Pagination for action objects.'
    ];

    public function fields()
    {
        return [
            'total' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total records'
            ],
            'filtered' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'N records filtered'
            ],
            'actions' => [
                'args' => [
                    'sql' => [
                        'type' => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                        'description' => 'Field to add SQL operations'
                    ]
                ],
                'type' => Type::listOf(GraphQL::type('AdminAction')),
                'description' => 'List of actions filtered'
            ]
        ];
    }

    // resolver actions
    public function resolveActionsField($root, $args)
    {
        // get query ordered and limited
        $query = SQLService::getQueryOrderedAndLimited($root->query, $args['sql']);

        // get objects filtered
        $objects = $query->get();

        return $objects;
    }
}