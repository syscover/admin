<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Service
{
    /**
     * @param  array    $object     contain properties of territorial area 1
     * @return \Syscover\Admin\Models\TerritorialArea1
     */
    public static function create($object)
    {
        return TerritorialArea1::create($object);
    }

    /**
     * @param array     $object     contain properties of territorial area 1
     * @return \Syscover\Admin\Models\TerritorialArea1
     */
    public static function update($object)
    {
        $object = collect($object);

        TerritorialArea1::where('ix', $object->get('ix'))
            ->update([
                'id'    => $object->get('id'),
                'name'  => $object->get('name')
            ]);

        return TerritorialArea1::where('ix', $object->get('ix'))
            ->first();
    }
}