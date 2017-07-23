<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\User;

class UserQuery extends Query
{
    protected $attributes = [
        'name'          => 'UserQuery',
        'description'   => 'Query to get user'
    ];

    public function type()
    {
        return GraphQL::type('AdminUser');
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
        $query = SQLService::getQueryFiltered(User::builder(), $args['sql']);

        return $query->first();
    }
}