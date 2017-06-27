<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\Lang;

class LangQuery extends Query
{
    protected $attributes = [
        'name'          => 'LangQuery',
        'description'   => 'Query to get lang.'
    ];

    public function type()
    {
        return GraphQL::type('AdminLang');
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
        $query = SQLService::getQueryFiltered(Lang::builder(), $args['sql']);

        return $query->first();
    }
}