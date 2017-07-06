<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\FieldValue;

class FieldValueQuery extends Query
{
    protected $attributes = [
        'name'          => 'FieldValueQuery',
        'description'   => 'Query to get field value'
    ];

    public function type()
    {
        return GraphQL::type('AdminFieldValue');
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
        $query = SQLService::getQueryFiltered(FieldValue::builder(), $args['sql']);

        return $query->first();
    }
}