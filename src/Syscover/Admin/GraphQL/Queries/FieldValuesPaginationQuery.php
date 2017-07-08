<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\FieldValue;

class FieldValuesPaginationQuery extends Query
{
    protected $attributes = [
        'name'          => 'FieldValuesPaginationQuery',
        'description'   => 'Query to get list of field values'
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
        $query = SQLService::getQueryFiltered(FieldValue::builder(), $args['sql'], $args['filters']);

        // count records filtered
        $filtered = $query->count();

        // N total records
        $total = SQLService::countPaginateTotalRecords(FieldValue::builder(), $args['filters']);

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}