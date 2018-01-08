<?php namespace Syscover\Admin\GraphQL\Queries;

use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Query;

class SlugQuery extends Query
{
    protected $attributes = [
        'name'          => 'SlugQuery',
        'description'   => 'Query to get slug'
    ];

    public function type()
    {
        return Type::string();
    }

    public function args()
    {
        return [
            'model' => [
                'name'          => 'model',
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Model over check slug'
            ],
            'slug' => [
                'name'          => 'slug',
                'type'          => Type::nonNull(Type::string()),
                'description'   => 'Slug to be checked'
            ],
            'id' => [
                'name'          => 'id',
                'type'          => Type::int(),
                'description'   => 'Objects id that will be exclude on query'
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $model = new $args['model'];

        return $model->checkSlug(str_slug($args['slug']), $args['id']);
    }
}