<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Core\Services\SQLService;
use Syscover\Admin\Models\AttachmentMime;

class AttachmentMimeMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminAttachmentMime');
    }

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminAttachmentMimeInput'))
            ],
        ];
    }
}

class AddAttachmentMimeMutation extends AttachmentMimeMutation
{
    protected $attributes = [
        'name'          => 'addAttachmentMime',
        'description'   => 'Add new attachment mime'
    ];

    public function resolve($root, $args)
    {
        return AttachmentMime::create($args['object']);
    }
}

class UpdateAttachmentMimeMutation extends AttachmentMimeMutation
{
    protected $attributes = [
        'name' => 'updateAttachmentMime',
        'description' => 'Update attachment mime'
    ];

    public function resolve($root, $args)
    {
        AttachmentMime::where('id', $args['object']['id'])
            ->update($args['object']);

        return AttachmentMime::find($args['object']['id']);
    }
}

class DeleteAttachmentMimeMutation extends AttachmentMimeMutation
{
    protected $attributes = [
        'name' => 'deleteAttachmentMime',
        'description' => 'Delete attachment mime'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], AttachmentMime::class);

        return $object;
    }
}
