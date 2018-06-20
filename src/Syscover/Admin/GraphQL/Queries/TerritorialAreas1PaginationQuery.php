<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialAreas1PaginationQuery extends Query
{
    protected $attributes = [
        'name'          => 'TerritorialAreas1PaginationQuery',
        'description'   => 'Query to get list territorial areas 1'
    ];

    public function type()
    {
        return GraphQL::type('CoreObjectPagination');
    }

    public function args()
    {
        return [
            'filters' => [
                'name'          => 'filters',
                'type'          => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                'description'   => 'to filter queries'
            ],
            'sql' => [
                'name'          => 'sql',
                'type'          => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                'description'   => 'Field to add SQL operations'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $query = SQLService::getQueryFiltered(TerritorialArea1::builder(), $args['sql'], $args['filters']);

        // count records filtered
        $filtered = $query->count();

        // total records
        $total = SQLService::countPaginateTotalRecords(TerritorialArea1::builder());

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}