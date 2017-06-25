<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Package;
use Syscover\Core\Services\SQLService;


class PackagesPaginationQuery extends Query
{
    // to documentation
    protected $attributes = [
        'name'          => 'PackagesPaginationQuery',
        'description'   => 'Query to get list packages.'
    ];

    public function type()
    {
        return GraphQL::type('AdminPackagePagination');
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
        $query = SQLService::getQueryFiltered(Package::builder(), $args);

        // count records filtered
        $filtered = $query->count();

        // N total records
        $total = SQLService::countPaginateTotalRecords(Package::builder(), $args);

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}