<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Field;

class FieldController extends CoreController
{
    protected $model = Field::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            // if there is id, is a new language object
            if($request->has('id'))
            {
                // get object to update data and data_lang field
                $field      = Field::find($request->input('id'));

                // get values
                $dataLang   = $field->data_lang;
                $labels     = $field->labels;

                // set values
                $dataLang[] = $request->input('lang_id');
                $labels[$request->input('lang_id')] = $request->input('label');

                // update values
                $field->data_lang = $dataLang;
                $field->labels = $labels;

                $field->save();

                $object = $field;
            }
            else
            {
                $id = Field::max('id');
                $id++;

                // create new object
                $object = Field::create([
                    'id'                => $id,
                    'field_group_id'    => $request->input('field_group_id'),
                    'name'              => $request->input('name'),
                    'labels'            => [$request->input('lang_id') => $request->input('label')],
                    'field_type_id'     => $request->input('field_type_id'),
                    'field_type_name'   => $request->input('field_type_name', ''),
                    'data_type_id'      => $request->input('data_type_id'),
                    'data_type_name'    => $request->input('data_type_name', ''),
                    'required'          => $request->input('required'),
                    'sort'              => $request->input('sort'),
                    'max_length'        => $request->input('max_length'),
                    'pattern'           => $request->input('pattern'),
                    'label_size'        => $request->input('label_size'),
                    'field_size'        => $request->input('field_size'),
                    'data_lang'         => Field::addLangDataRecord($request->input('lang_id'))
                ]);
            }
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   int $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        try
        {
            Field::where('id', $id)->update([
                'field_group_id'    => $request->input('field_group_id'),
                'name'              => $request->input('name'),
                'labels'            => json_encode([$request->input('lang_id') => $request->input('label')]),
                'field_type_id'     => $request->input('field_type_id'),
                'field_type_name'   => $request->input('field_type_name', ''),
                'data_type_id'      => $request->input('data_type_id'),
                'data_type_name'    => $request->input('data_type_name', ''),
                'required'          => $request->input('required'),
                'sort'              => $request->input('sort'),
                'max_length'        => $request->input('max_length'),
                'pattern'           => $request->input('pattern'),
                'label_size'        => $request->input('label_size'),
                'field_size'        => $request->input('field_size'),
                'data_lang'         => Field::addLangDataRecord($request->input('lang_id'))
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = Field::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
