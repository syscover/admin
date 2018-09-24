<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Country;

class CountryService
{
    public static function create($object)
    {
        self::checkCreate($object);

        $object['data_lang'] = Country::addDataLang($object['lang_id'], $object['id']);

        return Country::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);

        if(empty($object['zones']) && is_array($object['zones'])) $object['zones'] = null;
        if(! empty($object['zones']) && is_array($object['zones']) && count($object['zones']) > 0) $object['zones'] = json_encode($object['zones']);

        Country::where('id', $object['id'])->update(self::builder($object, ['id', 'sort', 'prefix', 'zones']));
        Country::where('ix', $object['ix'])->update(self::builder($object, ['name', 'territorial_area_1', 'territorial_area_2', 'territorial_area_3']));

        return Country::find($object['ix']);
    }

    private static function builder($object, $filterKeys = null)
    {
        $object = collect($object);
        if($filterKeys) return $object->only($filterKeys)->toArray();

        return $object->only(['id', 'lang_id', 'name', 'slug', 'sort', 'prefix', 'territorial_area_1', 'territorial_area_2', 'territorial_area_3', 'zones', 'data_lang'])->toArray();
    }

    private static function checkCreate($object)
    {
        if(empty($object['id']))        throw new \Exception('You have to define a id field to create a country');
        if(empty($object['lang_id']))   throw new \Exception('You have to define a lang_id field to create a country');
        if(empty($object['name']))      throw new \Exception('You have to define a name field to create a country');
        if(empty($object['slug']))      throw new \Exception('You have to define a slug field to create a country');
        if(! empty($object['zones']) && ! is_array($object['zones'])) throw new \Exception('Zones field has to be a array to create a country');
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a country');
        if(empty($object['id'])) throw new \Exception('You have to define a id field to update a country');
        if(! empty($object['zones']) && ! is_array($object['zones'])) throw new \Exception('Zones field has to be a array to update a country');
    }
}