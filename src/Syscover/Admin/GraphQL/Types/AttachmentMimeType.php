<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AttachmentMimeType extends GraphQLType
{
    protected $attributes = [
        'name' => 'AttachmentMimeType',
        'description' => 'A attachment mime, filter files that you can upload in application sections'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of attachment mime'
            ],
            'resource_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The root of attachment mime'
            ],
            'resource' => [
                'type' => GraphQL::type('AdminResource'),
                'description' => 'Resource of attachment mime'
            ],
            'mime' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of attachment mime'
            ],
        ];
    }
}