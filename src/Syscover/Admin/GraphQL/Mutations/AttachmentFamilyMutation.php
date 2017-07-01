<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\AttachmentFamily;
use Syscover\Core\Services\SQLService;

class AttachmentFamilyMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminAttachmentFamily');
    }
}

class AddAttachmentFamilyMutation extends AttachmentFamilyMutation
{
    protected $attributes = [
        'name'          => 'addAttachmentFamily',
        'description'   => 'Add new attachment family'
    ];

    public function args()
    {
        return [
            'attachmentFamily' => [
                'name' => 'attachmentFamily',
                'type' => Type::nonNull(GraphQL::type('AdminAttachmentFamilyInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return AttachmentFamily::create($args['attachmentFamily']);
    }
}

class UpdateAttachmentFamilyMutation extends AttachmentFamilyMutation
{
    protected $attributes = [
        'name' => 'updateAttachmentFamily',
        'description' => 'Update attachment family'
    ];

    public function args()
    {
        return [
            'attachmentFamily' => [
                'name' => 'attachmentFamily',
                'type' => Type::nonNull(GraphQL::type('AdminAttachmentFamilyInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $args['attachmentFamily']['sizes'] = json_encode($args['attachmentFamily']['sizes']);

        AttachmentFamily::where('id', $args['attachmentFamily']['id'])
            ->update($args['attachmentFamily']);

        return AttachmentFamily::find($args['attachmentFamily']['id']);
    }
}

class DeleteAttachmentFamilyMutation extends AttachmentFamilyMutation
{
    protected $attributes = [
        'name' => 'deleteAttachmentFamily',
        'description' => 'Delete attachment family'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], AttachmentFamily::class);

        return $object;
    }
}
