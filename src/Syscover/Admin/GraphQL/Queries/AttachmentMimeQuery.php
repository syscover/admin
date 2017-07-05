<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\AttachmentMime;

class AttachmentMimeQuery extends Query
{
    protected $attributes = [
        'name'          => 'AttachmentMimeQuery',
        'description'   => 'Query to get attachment mime.'
    ];

    public function type()
    {
        return GraphQL::type('AdminAttachmentMime');
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
        $query = SQLService::getQueryFiltered(AttachmentMime::builder(), $args['sql']);

        return $query->first();
    }
}