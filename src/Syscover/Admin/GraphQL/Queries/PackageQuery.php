<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Package;

class PackageQuery extends Query
{
    protected $attributes = [
        'name'          => 'PackageQuery',
        'description'   => 'Query to get package.'
    ];

    public function type()
    {
        return GraphQL::type('AdminPackage');
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
        $query = SQLService::getQueryFiltered(Package::builder(), $args['sql']);

        return $query->first();
    }
}