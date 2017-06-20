<?php namespace Syscover\Admin\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Type as GraphQLType;

class PackageType extends GraphQLType {

    protected $attributes = [
        'name' => 'Package',
        'description' => 'A action'
    ];

    /*
       * Uncomment following line to make the type input object.
       * http://graphql.org/learn/schema/#input-types
       */
    // protected $inputObject = true;

    public function fields()
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The id of action'
            ],
            'name' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ],
            'root' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'The name of action'
            ],
            'active' => [
                'type' => Type::nonNull(Type::boolean()),
                'description' => 'The name of action'
            ],
            'sort' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'The name of action'
            ]
        ];
    }


    // If you want to resolve the field yourself, you can declare a method
    // with the following format resolve[FIELD_NAME]Field()
    protected function resolveNameField($root, $args)
    {
        return strtolower($root->name);
    }

}