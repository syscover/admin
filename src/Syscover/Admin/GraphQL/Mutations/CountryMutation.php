<?php namespace Syscover\Admin\GraphQL\Mutations;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Folklore\GraphQL\Support\Mutation;
use Syscover\Admin\Models\Country;
use Syscover\Core\Services\SQLService;

class CountryMutation extends Mutation
{
    public function type()
    {
        return GraphQL::type('AdminCountry');
    }
}

class AddCountryMutation extends CountryMutation
{
    protected $attributes = [
        'name'          => 'addCountry',
        'description'   => 'Add new country'
    ];

    public function args()
    {
        return [
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminCountryInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $args['object']['data_lang'] = Country::addLangDataRecord($args['object']['lang_id'], $args['object']['id']);

        return Country::create($args['object']);
    }
}

class UpdateCountryMutation extends CountryMutation
{
    protected $attributes = [
        'name' => 'updateCountry',
        'description' => 'Update country'
    ];

    public function args()
    {
        return [
            'idOld' => [
                'name' => 'idOld',
                'type' => Type::nonNull(Type::string())
            ],
            'object' => [
                'name' => 'object',
                'type' => Type::nonNull(GraphQL::type('AdminCountryInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        Country::where('id', $args['idOld'])
            ->where('lang_id', $args['object']['lang_id'])
            ->update($args['object']);

        return Country::where('id', $args['object']['id'])
            ->where('lang_id', $args['object']['lang_id'])
            ->first();
    }
}

class DeleteCountryMutation extends CountryMutation
{
    protected $attributes = [
        'name' => 'deleteCountry',
        'description' => 'Delete country'
    ];

    public function args()
    {
        return [
            'id' => [
                'name' => 'id',
                'type' => Type::nonNull(Type::string())
            ],
            'lang' => [
                'name' => 'lang',
                'type' => Type::nonNull(Type::string())
            ]
        ];
    }

    public function resolve($root, $args)
    {
        $object = SQLService::destroyRecord($args['id'], Country::class, $args['lang']);

        return $object;
    }
}
