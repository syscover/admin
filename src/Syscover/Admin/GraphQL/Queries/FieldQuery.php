<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Field;

class FieldQuery extends Query
{
    protected $attributes = [
        'name'          => 'FieldQuery',
        'description'   => 'Query to get custom files.'
    ];

    public function type()
    {
        return GraphQL::type('AdminField');
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
        $query = SQLService::getQueryFiltered(Field::builder(), $args['sql']);

        return $query->first();
    }
}