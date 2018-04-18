<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\TerritorialArea2;

class TerritorialArea2Query extends Query
{
    protected $attributes = [
        'name'          => 'TerritorialArea2Query',
        'description'   => 'Query to get territorial area 2'
    ];

    public function type()
    {
        return GraphQL::type('AdminTerritorialArea2');
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
        $query = SQLService::getQueryFiltered(TerritorialArea2::builder(), $args['sql']);

        return $query->first();
    }
}