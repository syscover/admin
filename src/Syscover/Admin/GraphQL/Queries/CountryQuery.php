<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Country;

class CountryQuery extends Query
{
    protected $attributes = [
        'name'          => 'CountryQuery',
        'description'   => 'Query to get country.'
    ];

    public function type()
    {
        return GraphQL::type('AdminCountry');
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
        $query = SQLService::getQueryFiltered(Country::builder(), $args['sql']);

        return $query->first();
    }
}