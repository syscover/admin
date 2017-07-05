<?php namespace Syscover\Admin\GraphQL\Inputs;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class AttachmentMimeInput extends GraphQLType
{
    protected $attributes = [
        'name' => 'AttachmentMimeInput',
        'description' => 'A attachment mime, filter files that you can upload in application sections'
    ];

    protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::id(),
                'description' => 'The id of attachment mime'
            ],
            'resource_id' => [
                'type' => Type::id(),
                'description' => 'The root of attachment mime'
            ],
            'mime' => [
                'type' => Type::string(),
                'description' => 'The name of attachment mime'
            ],
        ];
    }
}