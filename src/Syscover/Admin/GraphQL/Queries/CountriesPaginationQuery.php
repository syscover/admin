<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Country;

class CountriesPaginationQuery extends Query
{
    // to documentation
    protected $attributes = [
        'name'          => 'CountriesPaginationQuery',
        'description'   => 'Query to get list countries.'
    ];

    public function type()
    {
        return GraphQL::type('AdminCountryPagination');
    }

    public function args()
    {
        return [
            'lang' => [
                'name'          => 'lang',
                'type'          => Type::string(),
                'description'   => 'to filter by lang'
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
        $query = SQLService::getQueryFiltered(Country::builder(), $args['sql'], $args['lang']);

        // count records filtered
        $filtered = $query->count();

        // N total records
        $total = SQLService::countPaginateTotalRecords(Country::builder(), $args['lang']);

        return (Object) [
            'total'     => $total,
            'filtered'  => $filtered,
            'query'     => $query
        ];
    }
}