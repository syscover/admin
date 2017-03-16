<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\CronJob;

class CronJobController extends CoreController
{
    /**
     * Display a listing of the resource.
     *
     * @return  \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $cronJobs = CronJob::builder()->get();

        $response['data'] = $cronJobs;

        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param   string  $id
     * @return  \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $cronJob = CronJob::builder()
            ->find($id);

        $response['data'] = $cronJob;

        return response()->json($response);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function edit($id, $lang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param   \Illuminate\Http\Request  $request
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id, $lang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param   int     $id
     * @param   string  $lang
     * @return  \Illuminate\Http\JsonResponse
     */
    public function destroy($id, $lang = null)
    {
        //
    }
}
