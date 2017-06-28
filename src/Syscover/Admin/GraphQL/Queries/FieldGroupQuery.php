<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\FieldGroup;

class FieldGroupQuery extends Query
{
    protected $attributes = [
        'name'          => 'FieldGroupQuery',
        'description'   => 'Query to get packages.'
    ];

    public function type()
    {
        return GraphQL::type('AdminFieldGroup');
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
        $query = SQLService::getQueryFiltered(FieldGroup::builder(), $args['sql']);

        return $query->first();
    }
}