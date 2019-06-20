<?php namespace Syscover\Admin\Services;

use Syscover\Admin\Models\Permission;
use Syscover\Admin\Models\Profile;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Core\Services\Service;

class ProfileService extends Service
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
            $permissions = Permission::where('profile_id', $data['profile_id'])->get()->toArray();

            foreach ($permissions as &$permission)
            {
                $permission['profile_id'] = $profile->id;
            }

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
