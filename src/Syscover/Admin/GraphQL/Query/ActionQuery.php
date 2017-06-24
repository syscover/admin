<?php namespace Syscover\Admin\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Action;
use Syscover\Core\Services\SQLService;

class ActionQuery extends Query
{
    protected $attributes = [
        'name'          => 'ActionQuery',
        'description'   => 'Query to get action.'
    ];

    public function type()
    {
        return GraphQL::type('AdminAction');
    }

    public function args()
    {
        return [
            'sql' => [
                'type'          => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                'description'   => 'Field to add SQL operations'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $query = SQLService::getQueryFiltered(Action::builder(), $args);

        return $query->first();
    }
}