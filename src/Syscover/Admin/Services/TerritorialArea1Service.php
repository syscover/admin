<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Country;
use Syscover\Admin\Models\TerritorialArea1;

class TerritorialArea1Service
{
    /**
     * @param  array    $object     contain properties of territorial area 1
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create($object)
    {
        return TerritorialArea1::create($object);
    }

    /**
     * @param array     $object     contain properties of territorial area 1
     * @param int       $id         old id of territorial area 1
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object, $id)
    {
        $object = collect($object);

        TerritorialArea1::where('id', $id)
            ->update([
                'id'    => $object->get('id'),
                'name'  => $object->get('name')
            ]);

        return TerritorialArea1::where('id', $object->get('id'))
            ->first();
    }
}