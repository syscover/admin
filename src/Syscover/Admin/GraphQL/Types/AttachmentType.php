<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AttachmentType extends GraphQLType
{
    protected $attributes = [
        'name'          => 'AttachmentInput',
        'description'   => 'Attachment'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of action'
            ],
            'lang_id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id lang of this attachment'
            ],
            'object_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id object who belong this attachment'
            ],
            'object_type' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Class name from who belong this attachment'
            ],
            'family_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The attachment family that has assigned'
            ],
            'sort' => [
                'type' => Type::int(),
                'description' => 'Sort of this attachment'
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
            'library_id' => [
                'type' => Type::int(),
                'description' => 'Library from who was it created this attachment'
            ],
            'library_file_name' => [
                'type' => Type::string(),
                'description' => 'Name of file in library'
            ],
            'data_lang' => [
                'type' => Type::listOf(Type::string()),
                'description' => 'JSON string that contain information about object translations'
            ]
        ];
    }

    public function interfaces() {
        return [GraphQL::type('CoreObjectInterface')];
    }
}