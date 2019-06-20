<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Permission;
use Syscover\Admin\Models\Profile;
use Syscover\Core\Exceptions\ModelNotChangeException;

class ProfileService
{
    public function store(array $data)
    {
        $this->validate($data, [
            'name'          => 'required|between:2,255',
            'profile_id'    => 'nullable|integer'
        ]);

        $profile = Profile::create($data);

        // check if has to copy permissions
        if (! empty($data['profile_id']))
        {
            $permissions = Permission::where('profile_id', $data['profile_id'])->get();

            $permissions->transform(function($item) use ($data) {
               return $item->profile_id = $data['profile_id'];
            });

            Permission::insert($permissions);
        }

        return $profile;
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'id'    => 'integer',
            'name'  => 'between:2,255'
        ]);

        $object = Profile::findOrFail($id);

        $object->fill($data);

        // check is model
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        return $object;
    }
}
