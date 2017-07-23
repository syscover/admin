<?php namespace Syscover\Admin\GraphQL;

use GraphQL;

class AdminGraphQLServiceProvider
{
    public static function bootGraphQLTypes()
    {
        // ACTION
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ActionType::class, 'AdminAction');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ActionInput::class, 'AdminActionInput');

        // PACKAGE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\PackageType::class, 'AdminPackage');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\PackageInput::class, 'AdminPackageInput');

        // LANG
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\LangType::class, 'AdminLang');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\LangInput::class, 'AdminLangInput');

        // COUNTRY
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\CountryType::class, 'AdminCountry');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\CountryInput::class, 'AdminCountryInput');

        // RESOURCE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ResourceType::class, 'AdminResource');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ResourceInput::class, 'AdminResourceInput');

        // PROFILE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\ProfileType::class, 'AdminProfile');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\ProfileInput::class, 'AdminProfileInput');

        // FIELD GROUP
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\FieldGroupType::class, 'AdminFieldGroup');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\FieldGroupInput::class, 'AdminFieldGroupInput');

        // FIELD
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\FieldType::class, 'AdminField');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\FieldInput::class, 'AdminFieldInput');

        // FIELD VALUE
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\FieldValueType::class, 'AdminFieldValue');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\FieldValueInput::class, 'AdminFieldValueInput');

        // ATTACHMENT FAMILY
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\AttachmentFamilyType::class, 'AdminAttachmentFamily');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\AttachmentFamilyInput::class, 'AdminAttachmentFamilyInput');

        // ATTACHMENT MIME
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\AttachmentMimeType::class, 'AdminAttachmentMime');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\AttachmentMimeInput::class, 'AdminAttachmentMimeInput');

        // ATTACHMENT
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\AttachmentType::class, 'AdminAttachment');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\AttachmentInput::class, 'AdminAttachmentInput');

        // ATTACHMENT LIBRARY
        GraphQL::addType(\Syscover\Admin\GraphQL\Types\AttachmentLibrary::class, 'AdminAttachmentLibrary');
        GraphQL::addType(\Syscover\Admin\GraphQL\Inputs\AttachmentLibraryInput::class, 'AdminAttachmentLibraryInput');

    }

    public static function bootGraphQLSchema()
    {
        GraphQL::addSchema('default', array_merge_recursive(GraphQL::getSchemas()['default'], [
            'query' => [
                // ACTION
                'adminActionsPagination'        => \Syscover\Admin\GraphQL\Queries\ActionsPaginationQuery::class,
                'adminActions'                  => \Syscover\Admin\GraphQL\Queries\ActionsQuery::class,
                'adminAction'                   => \Syscover\Admin\GraphQL\Queries\ActionQuery::class,

                // PACKAGE
                'adminPackagesPagination'       => \Syscover\Admin\GraphQL\Queries\PackagesPaginationQuery::class,
                'adminPackages'                 => \Syscover\Admin\GraphQL\Queries\PackagesQuery::class,
                'adminPackage'                  => \Syscover\Admin\GraphQL\Queries\PackageQuery::class,

                // LANG
                'adminLangsPagination'          => \Syscover\Admin\GraphQL\Queries\LangsPaginationQuery::class,
                'adminLangs'                    => \Syscover\Admin\GraphQL\Queries\LangsQuery::class,
                'adminLang'                     => \Syscover\Admin\GraphQL\Queries\LangQuery::class,

                // COUNTRY
                'adminCountriesPagination'      => \Syscover\Admin\GraphQL\Queries\CountriesPaginationQuery::class,
                'adminCountries'                => \Syscover\Admin\GraphQL\Queries\CountriesQuery::class,
                'adminCountry'                  => \Syscover\Admin\GraphQL\Queries\CountryQuery::class,

                // RESOURCE
                'adminResourcesPagination'      => \Syscover\Admin\GraphQL\Queries\ResourcesPaginationQuery::class,
                'adminResources'                => \Syscover\Admin\GraphQL\Queries\ResourcesQuery::class,
                'adminResource'                 => \Syscover\Admin\GraphQL\Queries\ResourceQuery::class,

                // PROFILE
                'adminProfilesPagination'       => \Syscover\Admin\GraphQL\Queries\ProfilesPaginationQuery::class,
                'adminProfiles'                 => \Syscover\Admin\GraphQL\Queries\ProfilesQuery::class,
                'adminProfile'                  => \Syscover\Admin\GraphQL\Queries\ProfileQuery::class,

                // FIELD GROUP
                'adminFieldGroupsPagination'    => \Syscover\Admin\GraphQL\Queries\FieldGroupsPaginationQuery::class,
                'adminFieldGroups'              => \Syscover\Admin\GraphQL\Queries\FieldGroupsQuery::class,
                'adminFieldGroup'               => \Syscover\Admin\GraphQL\Queries\FieldGroupQuery::class,

                // FIELD
                'adminFieldsPagination'         => \Syscover\Admin\GraphQL\Queries\FieldsPaginationQuery::class,
                'adminFields'                   => \Syscover\Admin\GraphQL\Queries\FieldsQuery::class,
                'adminField'                    => \Syscover\Admin\GraphQL\Queries\FieldQuery::class,

                // FIELD VALUE
                'adminFieldValuesPagination'    => \Syscover\Admin\GraphQL\Queries\FieldValuesPaginationQuery::class,
                'adminFieldValues'              => \Syscover\Admin\GraphQL\Queries\FieldvaluesQuery::class,
                'adminFieldValue'               => \Syscover\Admin\GraphQL\Queries\FieldValueQuery::class,

                // ATTACHMENT FAMILY
                'adminAttachmentFamiliesPagination' => \Syscover\Admin\GraphQL\Queries\AttachmentFamiliesPaginationQuery::class,
                'adminAttachmentFamilies'           => \Syscover\Admin\GraphQL\Queries\AttachmentFamiliesQuery::class,
                'adminAttachmentFamily'             => \Syscover\Admin\GraphQL\Queries\AttachmentFamilyQuery::class,

                // ATTACHMENT MIME
                'adminAttachmentMimesPagination'    => \Syscover\Admin\GraphQL\Queries\AttachmentMimesPaginationQuery::class,
                'adminAttachmentMimes'              => \Syscover\Admin\GraphQL\Queries\AttachmentMimesQuery::class,
                'adminAttachmentMime'               => \Syscover\Admin\GraphQL\Queries\AttachmentMimeQuery::class,
            ],
            'mutation' => [
                // ACTION
                'adminAddAction'                => \Syscover\Admin\GraphQL\Mutations\AddActionMutation::class,
                'adminUpdateAction'             => \Syscover\Admin\GraphQL\Mutations\UpdateActionMutation::class,
                'adminDeleteAction'             => \Syscover\Admin\GraphQL\Mutations\DeleteActionMutation::class,

                // PACKAGE
                'adminAddPackage'               => \Syscover\Admin\GraphQL\Mutations\AddPackageMutation::class,
                'adminUpdatePackage'            => \Syscover\Admin\GraphQL\Mutations\UpdatePackageMutation::class,
                'adminDeletePackage'            => \Syscover\Admin\GraphQL\Mutations\DeletePackageMutation::class,

                // LANG
                'adminAddLang'                  => \Syscover\Admin\GraphQL\Mutations\AddLangMutation::class,
                'adminUpdateLang'               => \Syscover\Admin\GraphQL\Mutations\UpdateLangMutation::class,
                'adminDeleteLang'               => \Syscover\Admin\GraphQL\Mutations\DeleteLangMutation::class,

                // COUNTRY
                'adminAddCountry'               => \Syscover\Admin\GraphQL\Mutations\AddCountryMutation::class,
                'adminUpdateCountry'            => \Syscover\Admin\GraphQL\Mutations\UpdateCountryMutation::class,
                'adminDeleteCountry'            => \Syscover\Admin\GraphQL\Mutations\DeleteCountryMutation::class,

                // RESOURCE
                'adminAddResource'              => \Syscover\Admin\GraphQL\Mutations\AddResourceMutation::class,
                'adminUpdateResource'           => \Syscover\Admin\GraphQL\Mutations\UpdateResourceMutation::class,
                'adminDeleteResource'           => \Syscover\Admin\GraphQL\Mutations\DeleteResourceMutation::class,

                // PROFILE
                'adminAddProfile'               => \Syscover\Admin\GraphQL\Mutations\AddProfileMutation::class,
                'adminUpdateProfile'            => \Syscover\Admin\GraphQL\Mutations\UpdateProfileMutation::class,
                'adminDeleteProfile'            => \Syscover\Admin\GraphQL\Mutations\DeleteProfileMutation::class,

                // FIELD GROUP
                'adminAddFieldGroup'            => \Syscover\Admin\GraphQL\Mutations\AddFieldGroupMutation::class,
                'adminUpdateFieldGroup'         => \Syscover\Admin\GraphQL\Mutations\UpdateFieldGroupMutation::class,
                'adminDeleteFieldGroup'         => \Syscover\Admin\GraphQL\Mutations\DeleteFieldGroupMutation::class,

                // FIELD
                'adminAddField'                 => \Syscover\Admin\GraphQL\Mutations\AddFieldMutation::class,
                'adminUpdateField'              => \Syscover\Admin\GraphQL\Mutations\UpdateFieldMutation::class,
                'adminDeleteField'              => \Syscover\Admin\GraphQL\Mutations\DeleteFieldMutation::class,

                // FIELD VALUE
                'adminAddFieldValue'            => \Syscover\Admin\GraphQL\Mutations\AddFieldValueMutation::class,
                'adminUpdateFieldValue'         => \Syscover\Admin\GraphQL\Mutations\UpdateFieldValueMutation::class,
                'adminDeleteFieldValue'         => \Syscover\Admin\GraphQL\Mutations\DeleteFieldValueMutation::class,

                // ATTACHMENT FAMILY
                'adminAddAttachmentFamily'      => \Syscover\Admin\GraphQL\Mutations\AddAttachmentFamilyMutation::class,
                'adminUpdateAttachmentFamily'   => \Syscover\Admin\GraphQL\Mutations\UpdateAttachmentFamilyMutation::class,
                'adminDeleteAttachmentFamily'   => \Syscover\Admin\GraphQL\Mutations\DeleteAttachmentFamilyMutation::class,

                // ATTACHMENT MIME
                'adminAddAttachmentMime'        => \Syscover\Admin\GraphQL\Mutations\AddAttachmentMimeMutation::class,
                'adminUpdateAttachmentMime'     => \Syscover\Admin\GraphQL\Mutations\UpdateAttachmentMimeMutation::class,
                'adminDeleteAttachmentMime'     => \Syscover\Admin\GraphQL\Mutations\DeleteAttachmentMimeMutation::class,

                // ATTACHMENT
                'adminCropAttachment'           => \Syscover\Admin\GraphQL\Mutations\CropAttachmentMutation::class,
                'adminDeleteAttachment'         => \Syscover\Admin\GraphQL\Mutations\DeleteAttachmentMutation::class,
            ]
        ]));
    }
}