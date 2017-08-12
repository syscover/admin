<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Action;

class ActionService
{
    /**
     * @param $object   array   contain properties of action
     * @return $this|\Illuminate\Database\Eloquent\Model
     */
    public static function createService($object)
    {
        return Action::create($object);
    }

    /**
     * @param $object   array   contain properties of action
     * @param $id       int     old id of section
     * @return \Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null|static|static[]
     */
    public static function updateService($object, $id)
    {
        Action::where('id', $id)->update([
            'id'                => $object['id'],
            'name'              => $object['name']
        ]);

        return Action::find($object['id']);
    }
}