<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\GraphQL\ScalarTypes\ObjectType;

class AttachmentLibraryInput extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AttachmentLibraryInput',
        'description'   => 'Attachment library'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
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