<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\Country;

class CountriesPaginationQuery extends Query
{
    // to documentation
    protected $attributes = [
        'name'          => 'CountriesPaginationQuery',
        'description'   => 'Query to get list countries'
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
        return (Object) [
            // set setEagerLoads to clean eager loads to use FOUND_ROWS() MySql Function
            'query' => Country::calculateFoundRows()->builder()->setEagerLoads([])
        ];
    }

}