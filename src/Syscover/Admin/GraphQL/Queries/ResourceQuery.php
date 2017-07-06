<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Resource;

class ResourceQuery extends Query
{
    protected $attributes = [
        'name'          => 'ResourceQuery',
        'description'   => 'Query to get resource'
    ];

    public function type()
    {
        return GraphQL::type('AdminResource');
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
        $query = SQLService::getQueryFiltered(Resource::builder(), $args['sql']);

        return $query->first();
    }
}