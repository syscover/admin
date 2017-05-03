<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Package;

class PackageController extends CoreController
{
    protected $model = Package::class;

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
            $object = Package::create([
                'name' => $request->input('name'),
                'root' => $request->input('root'),
                'active' => $request->input('active'),
                'sort' => $request->input('sort')
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
            Package::where('id', $id)->update([
                'name' => $request->input('name'),
                'root' => $request->input('root'),
                'active' => $request->input('active'),
                'sort' => $request->input('sort')
            ]);
        }
        catch (\Exception $e)
        {
            $response['status'] = "error";
            $response['message'] = $e->getMessage();

            return response()->json($response, 500);
        }

        $object = Package::find($request->input('id'));

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
