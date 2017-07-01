<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Syscover\Admin\GraphQL\Types\AttachmentFamilyType;

class AttachmentFamilyInput extends AttachmentFamilyType
{
    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'The id of action'
            ],
            'resource_id' => [
                'type' => Type::nonNull(Type::string()),
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
}