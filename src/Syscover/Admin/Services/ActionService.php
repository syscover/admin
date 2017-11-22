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
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function update($object)
    {
        $object = collect($object);

        Action::where('ix', $object->get('ix'))->update([
            'id'        => $object->get('id'),
            'name'      => $object->get('name')
        ]);

        return Action::find($object->get('ix'));
    }
}