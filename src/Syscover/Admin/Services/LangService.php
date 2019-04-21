<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Lang;
use Syscover\Core\Exceptions\ModelNotChangeException;

class LangService
{
    public function store(array $data)
    {
        $this->validate($data, [
            'id'        => 'required|alpha|size:2|unique:lang,id',
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
