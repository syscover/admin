<?php namespace Syscover\Admin\Services;

use Syscover\Core\Services\Service;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Admin\Models\Lang;

class LangService extends Service
{
    public function create(array $data)
    {
        $this->validate($data, [
           // 'id'        => 'required|alpha|size:2|unique:lang,id',
            'name'      => 'required|between:2,255',
            'icon'      => 'required',
            'sort'      => 'min:0|numeric'
        ]);

        return Lang::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'ix'        => 'numeric',
            'id'        => 'required|alpha|size:2|unique:lang,id',
            'name'      => 'required|between:2,255',
            'icon'      => 'required',
            'sort'      => 'min:0|numeric'
        ]);

        $object = Lang::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }
}
