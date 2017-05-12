<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\FieldValue;


class FieldValueController extends CoreController
{
    protected $model = FieldValue::class;

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
            if($request->has('id'))
            {
                $id         = $request->input('id');
                $counter    = null; // the id is defined by user
            }
            else
            {
                $counter    = FieldValue::where('field_id', $request->input('field_id'))->max('counter'); // get max id from this field
                $counter++;
                $id         = $counter;
            }


//            if($request->input('action') === 'store')
//                $idLang     = null;
//            else
//                $idLang     = $id;

            // create new object
            $object = FieldValue::create([
                'id'            => $id,
                'lang_id'       => $request->input('lang_id'),
                'field_id'      => $request->input('field_id'),
                'counter'       => $counter,
                'name'          => $request->input('name'),
                'sort'          => $request->input('sort'),
                'featured'      => $request->input('featured'),
                'data_lang'     => FieldValue::addLangDataRecord($request->input('lang_id'), $idLang),
                'data'          => null
            ]);
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
                'data_lang'         => json_encode(Field::addLangDataRecord($request->input('lang_id')))
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
