<?php namespace Syscover\Admin\GraphQL;

use GraphQL;

class AdminGraphQLServiceProvider
{
    public static function bootGraphQLTypes()
    {
        GraphQL::addType(\Syscover\Admin\GraphQL\Type\ActionPaginationType::class, 'AdminActionPagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Type\ActionType::class, 'AdminAction');
        GraphQL::addType(\Syscover\Admin\GraphQL\Type\PackageType::class, 'AdminPackage');
        GraphQL::addType(\Syscover\Admin\GraphQL\Type\ResourceType::class, 'AdminResource');
    }

    public static function bootGraphQLSchema()
    {
        GraphQL::addSchema('default', [
            'query' => [
                'adminActionsPagination'    => \Syscover\Admin\GraphQL\Query\ActionsPaginationQuery::class,
                'adminAction'               => \Syscover\Admin\GraphQL\Query\ActionQuery::class,
                'adminPackages'             => \Syscover\Admin\GraphQL\Query\PackagesQuery::class,
                'adminResources'            => \Syscover\Admin\GraphQL\Query\ResourcesQuery::class
            ],
            'mutation' => [
                'addAdminAction'            => \Syscover\Admin\GraphQL\Mutation\AddActionMutation::class,
                'updateAdminAction'         => \Syscover\Admin\GraphQL\Mutation\UpdateActionMutation::class,
            ]
        ]);
    }
}