<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\GraphQL\Types\ObjectType;
use Syscover\Core\GraphQL\Types\AnyType;

class AttachmentLibrary extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AttachmentLibrary',
        'description'   => 'Attachment library'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => app(AnyType::class),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::string(),
                'description' => 'The name of attachment'
            ],
            'base_path' => [
                'type' => Type::string(),
                'description' => 'Base path attachment'
            ],
            'file_name' => [
                'type' => Type::string(),
                'description' => 'Filename attachment'
            ],
            'url' => [
                'type' => Type::string(),
                'description' => 'Url attachment'
            ],
            'mime' => [
                'type' => Type::string(),
                'description' => 'Attachment mime file'
            ],
            'extension' => [
                'type' => Type::string(),
                'description' => 'Extension from attachment file'
            ],
            'size' => [
                'type' => Type::string(),
                'description' => 'Size from attachment file'
            ],
            'width' => [
                'type' => Type::string(),
                'description' => 'Width from attachment file'
            ],
            'height' => [
                'type' => Type::string(),
                'description' => 'Height from attachment file'
            ],
            'data' => [
                'type' => app(ObjectType::class),
                'description' => 'JSON string that contain information about object translations'
            ]
        ];
    }
}