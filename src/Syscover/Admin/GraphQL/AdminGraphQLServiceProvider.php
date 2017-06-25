<?php namespace Syscover\Admin\GraphQL;

use GraphQL;

class AdminGraphQLServiceProvider
{
    public static function bootGraphQLTypes()
    {
        // ACTIONS
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ActionPaginationType::class, 'AdminActionPagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ActionType::class, 'AdminAction');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ActionInput::class, 'AdminActionInput');

        // PACKAGES
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\PackagePaginationType::class, 'AdminPackagePagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\PackageType::class, 'AdminPackage');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\PackageInput::class, 'AdminPackageInput');

        //GraphQL::addType(\Syscover\Admin\GraphQL\Type\ResourceType::class, 'AdminResource');



    }

    public static function bootGraphQLSchema()
    {
        GraphQL::addSchema('default', [
            'query' => [
                // ACTIONS
                'adminActionsPagination'    => \Syscover\Admin\GraphQL\Queries\ActionsPaginationQuery::class,
                'adminAction'               => \Syscover\Admin\GraphQL\Queries\ActionQuery::class,

                // PACKAGES
                'adminPackagesPagination'   => \Syscover\Admin\GraphQL\Queries\PackagesPaginationQuery::class,
                'adminPackage'              => \Syscover\Admin\GraphQL\Queries\PackageQuery::class,

                // RESOURCES
                //'adminResources'            => \Syscover\Admin\GraphQL\Query\ResourcesQuery::class
            ],
            'mutation' => [
                // ACTIONS
                'adminAddAction'            => \Syscover\Admin\GraphQL\Mutations\AddActionMutation::class,
                'adminUpdateAction'         => \Syscover\Admin\GraphQL\Mutations\UpdateActionMutation::class,
                'adminDeleteAction'         => \Syscover\Admin\GraphQL\Mutations\DeleteActionMutation::class,

                // PACKAGES
                'adminAddPackage'           => \Syscover\Admin\GraphQL\Mutations\AddPackageMutation::class,
                'adminUpdatePackage'        => \Syscover\Admin\GraphQL\Mutations\UpdatePackageMutation::class,
                'adminDeletePackage'        => \Syscover\Admin\GraphQL\Mutations\DeletePackageMutation::class,
            ]
        ]);
    }
}