<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\TerritorialArea2;

class TerritorialAreas2PaginationQuery extends Query
{
    protected $attributes = [
        'name'          => 'TerritorialAreas1PaginationQuery',
        'description'   => 'Query to get list territorial areas 2'
    ];

    public function type()
    {
        return GraphQL::type('CoreObjectPagination');
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
        $query = SQLService::getQueryFiltered(TerritorialArea2::builder(), empty($args['sql']) ? [] : $args['sql']);

        // count records filtered
        $filtered = $query->count();

        // total records
        $total = SQLService::countPaginateTotalRecords(TerritorialArea2::builder());

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}