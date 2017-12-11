<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;
use Syscover\Admin\Models\CronJob;
use Syscover\Core\Services\SQLService;

class CronJobQuery extends Query
{
    protected $attributes = [
        'name'          => 'CronJobQuery',
        'description'   => 'Query to get cron job'
    ];

    public function type()
    {
        return GraphQL::type('AdminCronJob');
    }

    public function args()
    {
        return [
            'sql' => [
                'name'          => 'sql',
                'type'          => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                'description'   => 'Field to add SQL operations'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $query = SQLService::getQueryFiltered(CronJob::builder(), $args['sql']);

        return $query->first();
    }
}