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
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminAttachmentFamilyInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return AttachmentFamily::create($args['object']);
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
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminAttachmentFamilyInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $args['object']['sizes'] = json_encode($args['object']['sizes']);

        AttachmentFamily::where('id', $args['object']['id'])
            ->update($args['object']);

        return AttachmentFamily::find($args['object']['id']);
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
                'type' => Type::nonNull(Type::int())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], AttachmentFamily::class);

        return $object;
    }
}
