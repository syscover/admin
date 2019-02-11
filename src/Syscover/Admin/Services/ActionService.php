<?php namespace Syscover\Admin\Services;

use Syscover\Core\Exceptions\ModelNotChangeException;
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

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'id'    => 'between:2,25|unique:admin_action,id',
            'name'  => 'between:2,255'
        ]);

        $object = Action::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }
}
