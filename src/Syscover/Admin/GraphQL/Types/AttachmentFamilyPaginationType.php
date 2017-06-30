<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\Services\SQLService;

class AttachmentFamilyPaginationType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AttachmentFamilyPaginationType',
        'description'   => 'Pagination for attachment families objects.'
    ];

    public function fields()
    {
        return [
            'total' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total records'
            ],
            'filtered' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'N records filtered'
            ],
            'attachmentFamilies' => [
                'type' => Type::listOf(GraphQL::type('AdminAttachmentFamily')),
                'description' => 'List of attachment families filtered',
                'args' => [
                    'sql' => [
                        'type' => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                        'description' => 'Field to add SQL operations'
                    ]
                ]
            ]
        ];
    }

    public function resolveAttachmentFamiliesField($root, $args)
    {
        // get query ordered and limited
        $query = SQLService::getQueryOrderedAndLimited($root->query, $args['sql']);

        // get objects filtered
        $objects = $query->get();

        return $objects;
    }
}