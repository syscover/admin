<?php namespace Syscover\Admin\GraphQL\Query;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Action;
use Syscover\Core\Services\SQLService;


class ActionsPaginationQuery extends Query
{
    // to documentation
    protected $attributes = [
        'name'          => 'ActionsPaginationQuery',
        'description'   => 'Query to get list actions.'
    ];

    public function type()
    {
        return GraphQL::type('AdminActionPagination');
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
        // count records filtered
        $filtered = $query->count();
        // N total records
        $total = SQLService::countPaginateTotalRecords(Action::builder(), $args);

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}