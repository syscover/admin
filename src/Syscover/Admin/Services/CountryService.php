<?php namespace Syscover\Admin\Services;

use Syscover\Core\Services\Service;
use Syscover\Core\Exceptions\ModelNotChangeException;
use Syscover\Admin\Models\Country;

class CountryService extends Service
{
    public function store(array $data)
    {
        $this->validate($data, [
            'id'                => 'required|alpha|size:2',
            'lang_id'           => 'required',
            'name'              => 'required|between:2,100',
            'slug'              => 'required|between:1,255',
            'sort'              => 'nullable|min:0|numeric',
            'prefix'            => 'between:1,5',
            'territorialArea1'  => 'between:0,50',
            'territorialArea2'  => 'between:0,50',
            'territorialArea3'  => 'between:0,50',
            'latitude'          => 'numeric',
            'longitude'         => 'numeric',
            'zoom'              => 'integer',
            'zones'             => 'array'
        ]);

        $object['data_lang'] = Country::getDataLang($data['lang_id'], $data['id']);

        return Country::create($data);
    }

    public function update(array $data, int $id)
    {
        $this->validate($data, [
            'ix'                => 'required|integer',
            'id'                => 'required|alpha|size:2',
            'lang_id'           => 'required',
            'name'              => 'required|between:2,100',
            'slug'              => 'required|between:1,255',
            'sort'              => 'nullable|min:0|numeric',
            'prefix'            => 'between:1,5',
            'territorialArea1'  => 'between:0,50',
            'territorialArea2'  => 'between:0,50',
            'territorialArea3'  => 'between:0,50',
            'latitude'          => 'numeric',
            'longitude'         => 'numeric',
            'zoom'              => 'integer',
            'zones'             => 'array'
        ]);

        $object = Country::findOrFail($id);

        $object->fill($data);

        // check is model has changed
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        // save changes in all object, with the same id
        // this method is exclusive form elements multi language
        $commonData = $object->only('id', 'sort', 'prefix', 'zones');

        // save zones, an parse array object by json_encode function
        $commonData['zones'] = ! empty($commonData['zones']) && is_array($commonData['zones']) && count($commonData['zones']) > 0 ? json_encode($commonData['zones']) : null;

        Country::where('id', $object->id)->update($commonData);

        return $object;
    }
}
