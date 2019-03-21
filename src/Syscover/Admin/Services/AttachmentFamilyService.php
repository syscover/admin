<?php namespace Syscover\Admin\Services;

use Syscover\Core\Services\Service;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Admin\Models\AttachmentFamily;

class AttachmentFamilyService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'resource_id'   => 'required|exists:admin_resource,id',
            'name'          => 'required|between:2,255',
            'width'         => 'nullable|integer',
            'height'        => 'nullable|integer',
            'fit_type'      => 'nullable|integer|in:1,2,3,4,5',
            'sizes'         => 'nullable|array',
            'quality'       => 'nullable|integer|between:1,100',
            'format'        => 'nullable|in:jpg,png,gif,tif,bmp,data-url'
        ]);

        return AttachmentFamily::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'id'            => 'integer',
            'resource_id'   => 'required|exists:admin_resource,id',
            'name'          => 'required|between:2,255',
            'width'         => 'nullable|integer',
            'height'        => 'nullable|integer',
            'fit_type'      => 'nullable|integer|in:1,2,3,4,5',
            'sizes'         => 'nullable|array',
            'quality'       => 'nullable|integer|between:1,100',
            'format'        => 'nullable|in:jpg,png,gif,tif,bmp,data-url'
        ]);

        $object = AttachmentFamily::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }
}
