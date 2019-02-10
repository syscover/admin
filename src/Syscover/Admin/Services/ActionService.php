<?php namespace Syscover\Admin\Services;

use Syscover\Core\Services\Service;
use Syscover\Admin\Models\Action;

class ActionService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'id'    => 'required|between:2,25|unique:admin_action,id',
            'name'  => 'required|between:2,255'
        ]);

        return Action::create($data);
    }

    public static function create($object)
    {
        self::checkCreate($object);
        return Action::create(self::builder($object));
    }

    public static function update($object)
    {
        self::checkUpdate($object);
        Action::where('ix', $object['ix'])->update(self::builder($object));

        return Action::find($object['ix']);
    }

    private static function builder($object)
    {
        $object = collect($object);
        return $object->only([
            'id',
            'name'
        ])->toArray();
    }

    private static function checkUpdate($object)
    {
        if(empty($object['ix'])) throw new \Exception('You have to define a ix field to update a action');
    }
}
