<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\CronJob;
use Syscover\Admin\Services\CronJobService;
use Syscover\Core\Services\SQLService;

class CronJobMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminCronJob');
    }
}

class AddCronJobMutation extends CronJobMutation
{
    protected $attributes = [
        'name'          => 'addCronJob',
        'description'   => 'Add new cron job'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminCronJobInput'))
            ],
        ];
    }

    public function resolve($root, $args)
    {
        return CronJobService::create($args['object']);
    }
}

class UpdateCronJobMutation extends CronJobMutation
{
    protected $attributes = [
        'name' => 'updateCronJob',
        'description' => 'Update cron job'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminCronJobInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return CronJobService::update($args['object']);
    }
}

class DeleteCronJobMutation extends CronJobMutation
{
    protected $attributes = [
        'name' => 'deleteCronJob',
        'description' => 'Delete cron job'
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
        $object = SQLService::destroyRecord($args['id'], CronJob::class);

        return $object;
    }
}
