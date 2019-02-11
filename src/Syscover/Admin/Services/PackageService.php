<?php namespace Syscover\Admin\Services;

use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Core\Services\Service;
use Syscover\Admin\Models\Package;

class PackageService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'name'      => 'required|between:2,255',
            'root'      => 'required|between:2,255',
            'active'    => 'required',
            'sort'      => 'required|numeric|min:0'
        ]);

        Package::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'name'      => 'between:2,255',
            'root'      => 'between:2,255',
            'sort'      => 'numeric|min:0'
        ]);

        $object = Package::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }
}
