<?php namespace Syscover\Admin\GraphQL\Types;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;
use Syscover\Core\Services\SQLService;

class PackagePaginationType extends GraphQLType
{
    // to documentation
    protected $attributes = [
        'name'          => 'PackagePaginationType',
        'description'   => 'Pagination for package objects.'
    ];

    public function fields()
    {
        return [
            'total' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The total records'
            ],
            'filtered' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'N records filtered'
            ],
            'packages' => [
                'args' => [
                    'sql' => [
                        'type' => Type::listOf(GraphQL::type('CoreSQLQueryInput')),
                        'description' => 'Field to add SQL operations'
                    ]
                ],
                'type' => Type::listOf(GraphQL::type('AdminPackage')),
                'description' => 'List of packages filtered'
            ]
        ];
    }

    // resolver actions
    public function resolvePackagesField($root, $args)
    {
        $query = $root->query;

        if(isset($args['sql']))
        {
            // get query ordered and limited
            $query = SQLService::getQueryOrderedAndLimited($root->query, $args['sql']);
        }

        // get objects filtered
        $objects = $query->get();

        return $objects;
    }
}