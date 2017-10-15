<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Services\FieldValueService;
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
        $response['status'] = "success";
        $response['data']   = FieldValueService::create($request->all());

        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request $request
     * @param   int $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $fieldId, $id, $lang)
    {
        try
        {
            if($request->has('id'))
            {
                $idAux      = $request->input('id');
                $counter    = null; // the id is defined by user
            }
            else
            {
                // when update value, if id is autoincrement, is not possible change id
                $idAux = $id;
            }

            FieldValue::where('field_id', $fieldId)->where('id', $id)->where('lang_id', $lang)->update([
                'id'            => $idAux,
                'name'          => $request->input('name'),
                'sort'          => $request->input('sort'),
                'featured'      => $request->input('featured')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = FieldValue::where('field_id', $fieldId)
            ->where('id', $idAux)
            ->where('lang_id', $lang)
            ->first();

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
