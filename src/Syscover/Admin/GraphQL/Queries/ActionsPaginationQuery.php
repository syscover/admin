<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Action;

class ActionsPaginationQuery extends Query
{
    protected $attributes = [
        'name'          => 'ActionsPaginationQuery',
        'description'   => 'Query to get list actions'
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
        $query = SQLService::getQueryFiltered(Action::builder(), $args['sql']);

        // count records filtered
        $filtered = $query->count();

        // total records
        $total = SQLService::countPaginateTotalRecords(Action::builder());

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}