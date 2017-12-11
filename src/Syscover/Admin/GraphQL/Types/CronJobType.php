<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class CronJobType extends GraphQLType
{
    protected $attributes = [
        'name' => 'CronJob',
        'description' => 'Cron job that can to be execute'
    ];

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The id of cron job'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of cron job'
            ],
            'package_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Package id from resource'
            ],
            'package' => [
                'type' => GraphQL::type('AdminPackage'),
                'description' => 'Package of resource'
            ],
            'cron_expression' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Cron expression to know execution time'
            ],
            'command' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Command that will be executed'
            ],
            'last_run' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Last run of cron job'
            ],
            'next_run' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Next run of cron job'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'Set if cron job is active'
            ]
        ];
    }
}