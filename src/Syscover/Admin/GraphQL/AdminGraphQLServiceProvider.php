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

        // COUNTRY
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\CountryPaginationType::class, 'AdminCountryPagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\CountryType::class, 'AdminCountry');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\CountryInput::class, 'AdminCountryInput');

        // RESOURCE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ResourcePaginationType::class, 'AdminResourcePagination');
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ResourceType::class, 'AdminResource');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ResourceInput::class, 'AdminResourceInput');

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
                'adminPackages'              => \Syscover\Admin\GraphQL\Queries\PackagesQuery::class,
                'adminPackage'              => \Syscover\Admin\GraphQL\Queries\PackageQuery::class,

                // LANG
                'adminLangsPagination'      => \Syscover\Admin\GraphQL\Queries\LangsPaginationQuery::class,
                'adminLang'                 => \Syscover\Admin\GraphQL\Queries\LangQuery::class,

                // COUNTRY
                'adminCountriesPagination'  => \Syscover\Admin\GraphQL\Queries\CountriesPaginationQuery::class,
                'adminCountry'              => \Syscover\Admin\GraphQL\Queries\CountryQuery::class,

                // RESOURCE
                'adminResourcesPagination'   => \Syscover\Admin\GraphQL\Queries\ResourcesPaginationQuery::class,
                'adminResource'              => \Syscover\Admin\GraphQL\Queries\ResourceQuery::class,
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

                // LANG
                'adminAddLang'              => \Syscover\Admin\GraphQL\Mutations\AddLangMutation::class,
                'adminUpdateLang'           => \Syscover\Admin\GraphQL\Mutations\UpdateLangMutation::class,
                'adminDeleteLang'           => \Syscover\Admin\GraphQL\Mutations\DeleteLangMutation::class,

                // COUNTRY
                'adminAddCountry'           => \Syscover\Admin\GraphQL\Mutations\AddCountryMutation::class,
                'adminUpdateCountry'        => \Syscover\Admin\GraphQL\Mutations\UpdateCountryMutation::class,
                'adminDeleteCountry'        => \Syscover\Admin\GraphQL\Mutations\DeleteCountryMutation::class,

                // RESOURCE
                'adminAddResource'          => \Syscover\Admin\GraphQL\Mutations\AddResourceMutation::class,
                'adminUpdateResource'       => \Syscover\Admin\GraphQL\Mutations\UpdateResourceMutation::class,
                'adminDeleteResource'       => \Syscover\Admin\GraphQL\Mutations\DeleteResourceMutation::class,
            ]
        ]);
    }
}