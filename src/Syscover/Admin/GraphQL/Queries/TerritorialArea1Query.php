<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Query extends Query
{
    protected $attributes = [
        'name'          => 'TerritorialArea1Query',
        'description'   => 'Query to get territorial area 1'
    ];

    public function type()
    {
        return GraphQL::type('AdminTerritorialArea1');
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
        $query = SQLService::getQueryFiltered(TerritorialArea1::builder(), $args['sql']);

        return $query->first();
    }
}