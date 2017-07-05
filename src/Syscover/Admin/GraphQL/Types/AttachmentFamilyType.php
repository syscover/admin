<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AttachmentFamilyType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AttachmentFamily',
        'description'   => 'AttachmentFamily to add to any image to set crop'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The id of action'
            ],
            'resource_id' => [
                'type' => Type::nonNull(Type::id()),
                'description' => 'The resource who belong this attachment'
            ],
            'resource' => [
                'type' => GraphQL::type('AdminResource'),
                'description' => 'The resource who belong this attachment'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of action'
            ],
            'width' => [
                'type' => Type::int(),
                'description' => 'The width of crop for this attachment'
            ],
            'height' => [
                'type' => Type::int(),
                'description' => 'The width of crop for this attachment'
            ],
            'sizes' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'The width of crop for this attachment'
            ],
            'quality' => [
                'type' => Type::int(),
                'description' => 'Quality of images in jpg format'
            ],
            'format' => [
                'type' => Type::string(),
                'description' => 'The name of action'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}