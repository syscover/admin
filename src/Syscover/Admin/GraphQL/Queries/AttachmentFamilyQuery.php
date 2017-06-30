<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\AttachmentFamily;

class AttachmentFamilyQuery extends Query
{
    protected $attributes = [
        'name'          => 'AttachmentFamily',
        'description'   => 'Query to get attachment family.'
    ];

    public function type()
    {
        return GraphQL::type('AdminAttachmentFamily');
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
        $query = SQLService::getQueryFiltered(AttachmentFamily::builder(), $args['sql']);

        return $query->first();
    }
}