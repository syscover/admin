<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Profile;

class ProfileQuery extends Query
{
    protected $attributes = [
        'name'          => 'ProfileQuery',
        'description'   => 'Query to get profile.'
    ];

    public function type()
    {
        return GraphQL::type('AdminProfile');
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
        $query = SQLService::getQueryFiltered(Profile::builder(), $args['sql']);

        return $query->first();
    }
}