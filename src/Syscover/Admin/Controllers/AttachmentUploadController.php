<?php namespace Syscover\Admin\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class AttachmentUploadController extends BaseController
{
    public function index(Request $request)
    {
        $folder = $request->input('folder');
        $files = $request->file('files');

        $path = [];
        $libraryPath = [];
        foreach ($files as $file){
            $path[] = $file->store($folder);
            $libraryPath[] = $file->store('public/library');
        }

        $response['status'] = "success";
        $response['data'] = $path;

        return response()->json($response);
    }
}
