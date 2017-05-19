<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Admin\Models\AttachmentMime;
use Syscover\Core\Controllers\CoreController;

class AttachmentMimeController extends CoreController
{
    protected $model = AttachmentMime::class;

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
            $object = AttachmentMime::create([
                'resource_id'   => $request->input('resource_id'),
                'mime'          => $request->input('mime')
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
            AttachmentMime::where('id', $id)->update([
                'resource_id'   => $request->input('resource_id'),
                'mime'          => $request->input('mime')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = AttachmentMime::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
