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
            'lang_id'           => 'required|size:2|exists:admin_lang,id',
            'name'              => 'required|between:2,100',
            'slug'              => 'required|between:1,255',
            'sort'              => 'nullable|min:0|numeric',
            'prefix'            => 'nullable|between:1,5',
            'territorialArea1'  => 'between:0,50',
            'territorialArea2'  => 'between:0,50',
            'territorialArea3'  => 'between:0,50',
            'latitude'          => 'nullable|numeric',
            'longitude'         => 'nullable|numeric',
            'zoom'              => 'nullable|integer',
            'zones'             => 'array'
        ]);

        $data['data_lang'] = Country::getDataLang($data['lang_id'], $data['id']);

        return Country::create($data);
    }

    public function update(array $data, int $ix)
    {
        $this->validate($data, [
            'ix'                => 'required|integer',
            'id'                => 'required|alpha|size:2|exists:admin_lang,id',
            'lang_id'           => 'required|size:2',
            'name'              => 'required|between:2,100',
            'slug'              => 'required|between:1,255',
            'sort'              => 'nullable|min:0|numeric',
            'prefix'            => 'between:1,5',
            'territorialArea1'  => 'between:0,50',
            'territorialArea2'  => 'between:0,50',
            'territorialArea3'  => 'between:0,50',
            'latitude'          => 'nullable|numeric',
            'longitude'         => 'nullable|numeric',
            'zoom'              => 'nullable|integer',
            'zones'             => 'nullable|array'
        ]);

        $object = Country::findOrFail($ix);
        $oldId  = $object->id; // retrieve the id for common update

        $object->fill($data);

        // check is model has changed
        if ($object->isClean()) throw new ModelNotChangeException('At least one value must change');

        // save changes
        $object->save();

        // save changes in all object, with the same id
        // this method is exclusive form elements multi language
        $commonData = $object->only('id', 'sort', 'prefix', 'zones', 'latitude', 'longitude', 'zoom');

        // save zones, an parse array object by json_encode function
        $commonData['zones'] = ! empty($commonData['zones']) && is_array($commonData['zones']) && count($commonData['zones']) > 0 ? json_encode($commonData['zones']) : null;

        Country::where('id', $oldId)->update($commonData);

        return $object;
    }
}
