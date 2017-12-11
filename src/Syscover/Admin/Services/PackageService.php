<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Package;

class PackageService
{
    /**
     * @param  array    $object     contain properties of package
     * @return \Syscover\Admin\Models\Package
     */
    public static function create($object)
    {
        return  Package::create($object);
    }

    /**
     * @param array     $object     contain properties of package
     * @return \Syscover\Admin\Models\Package
     */
    public static function update($object)
    {
        $object = collect($object);

        Package::where('id', $object->get('id'))->update([
            'name'      => $object->get('name'),
            'root'      => $object->get('root'),
            'active'    => $object->get('active'),
            'sort'      => $object->get('sort')
        ]);

        return Package::find($object->get('id'));
    }
}