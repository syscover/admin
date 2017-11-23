<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Country;

class CountryService
{
    /**
     * @param  array    $object     contain properties of country
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create($object)
    {
        $object['data_lang'] = Country::addDataLang($object['lang_id'], $object['id']);

        return Country::create($object);
    }

    /**
     * @param array     $object     contain properties of country
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object)
    {
        $object = collect($object);

        Country::where('ix', $object->get('ix'))
            ->update([
                'name'                  => $object->get('name'),
                'sort'                  => $object->get('sort'),
                'territorial_area_1'    => $object->get('territorial_area_1'),
                'territorial_area_2'    => $object->get('territorial_area_2'),
                'territorial_area_3'    => $object->get('territorial_area_3')
            ]);

        // common data
        Country::where('ix', $object->get('ix'))
            ->update([
                'id'        => $object->get('id'),
                'prefix'    => $object->get('prefix'),
                'zones'     => $object->get('zones') === null || (is_array($object->get('zones')) && count($object->get('zones')) == 0) ? null : json_encode($object->get('zones'))
            ]);

        return Country::find($object->get('ix'));
    }
}