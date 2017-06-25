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
            'country' => [
                'name' => 'country',
                'type' => Type::nonNull(GraphQL::type('AdminCountryInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        return Country::create([
            'id'                    => $args['country']['id'],
            'lang_id'               => $args['country']['lang_id'],
            'name'                  => $args['country']['name'],
            'sort'                  => $args['country']['sort'],
            'prefix'                => $args['country']['prefix'],
            'territorial_area_1'    => $args['country']['territorial_area_1'],
            'territorial_area_2'    => $args['country']['territorial_area_2'],
            'territorial_area_3'    => $args['country']['territorial_area_3'],
            'data_lang'             => Country::addLangDataRecord($args['country']['lang_id'], $args['country']['id'])
        ]);
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
            'country' => [
                'name' => 'country',
                'type' => Type::nonNull(GraphQL::type('AdminCountryInput'))
            ]
        ];
    }

    public function resolve($root, $args)
    {
        Country::where('id', $args['idOld'])
            ->where('lang_id', $args['country']['lang_id'])
            ->update($args['country']);

        return Country::where('id', $args['country']['id'])
            ->where('lang_id', $args['country']['lang_id'])
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
        $object = SQLService::destroyRecord($args, Country::class);

        return $object;
    }
}
