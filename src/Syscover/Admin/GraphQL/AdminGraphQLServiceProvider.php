<?php namespace Syscover\Admin\GraphQL;

use GraphQL;

class AdminGraphQLServiceProvider
{
    public static function bootGraphQLTypes()
    {
        // ACTION
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ActionPaginationType::class, 'AdminActionPagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ActionType::class, 'AdminAction');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ActionInput::class, 'AdminActionInput');

        // PACKAGE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\PackagePaginationType::class, 'AdminPackagePagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\PackageType::class, 'AdminPackage');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\PackageInput::class, 'AdminPackageInput');

        // LANG
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\LangPaginationType::class, 'AdminLangPagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\LangType::class, 'AdminLang');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\LangInput::class, 'AdminLangInput');



    }

    public static function bootGraphQLSchema()
    {
        GraphQL::addSchema('default', [
            'query' => [
                // ACTION
                'adminActionsPagination'    => \Syscover\Admin\GraphQL\Queries\ActionsPaginationQuery::class,
                'adminAction'               => \Syscover\Admin\GraphQL\Queries\ActionQuery::class,

                // PACKAGE
                'adminPackagesPagination'   => \Syscover\Admin\GraphQL\Queries\PackagesPaginationQuery::class,
                'adminPackage'              => \Syscover\Admin\GraphQL\Queries\PackageQuery::class,

                // LANG
                'adminLangsPagination'      => \Syscover\Admin\GraphQL\Queries\LangsPaginationQuery::class,
                'adminLang'                 => \Syscover\Admin\GraphQL\Queries\LangQuery::class,
            ],
            'mutation' => [
                // ACTION
                'adminAddAction'            => \Syscover\Admin\GraphQL\Mutations\AddActionMutation::class,
                'adminUpdateAction'         => \Syscover\Admin\GraphQL\Mutations\UpdateActionMutation::class,
                'adminDeleteAction'         => \Syscover\Admin\GraphQL\Mutations\DeleteActionMutation::class,

                // PACKAGE
                'adminAddPackage'           => \Syscover\Admin\GraphQL\Mutations\AddPackageMutation::class,
                'adminUpdatePackage'        => \Syscover\Admin\GraphQL\Mutations\UpdatePackageMutation::class,
                'adminDeletePackage'        => \Syscover\Admin\GraphQL\Mutations\DeletePackageMutation::class,

                // PACKAGE
                'adminAddLang'              => \Syscover\Admin\GraphQL\Mutations\AddLangMutation::class,
                'adminUpdateLang'           => \Syscover\Admin\GraphQL\Mutations\UpdateLangMutation::class,
                'adminDeleteLang'           => \Syscover\Admin\GraphQL\Mutations\DeleteLangMutation::class,
            ]
        ]);
    }
}