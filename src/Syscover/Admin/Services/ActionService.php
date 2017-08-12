<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Action;

class ActionService
{
    /**
     * @param  array    $object     contain properties of action
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function create($object)
    {
        return Action::create($object);
    }

    /**
     * @param array     $object     contain properties of action
     * @param int       $id         old id of section
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object, $id)
    {
        $object = collect($object);

        Action::where('id', $id)->update([
            'id'    => $object->get('id'),
            'name'  => $object->get('name')
        ]);

        return Action::find($object->get('id'));
    }
}