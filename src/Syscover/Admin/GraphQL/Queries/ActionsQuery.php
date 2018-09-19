<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Action;

class ActionsQuery extends Query
{
    protected $attributes = [
        'name'          => 'ActionsQuery',
        'description'   => 'Query to get actions list'
    ];

    public function type()
    {
        return Type::listOf(GraphQL::type('AdminAction'));
    }

    public function args()
    {
        return [
            'sql' => [
                'name'          => 'sql',
                'type'          => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                'description'   => 'Field to add SQL operations'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $query = Action::builder();

        if(isset($args['sql']))
        {
            $query = SQLService::getQueryFiltered($query, $args['sql']);
            $query = SQLService::getQueryOrderedAndLimited($query, $args['sql']);
        }

        return $query->get();
    }
}