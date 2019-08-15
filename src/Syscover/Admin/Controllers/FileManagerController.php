<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Syscover\Core\Controllers\CoreController;

class FileManagerController extends CoreController
{
    public function read(Request $request)
    {
        $file = $request->input('file');
        
        header('Content-Type: ' . $file['mime'] ?? null);
        readfile($file['pathname'] ? storage_path($file['pathname']) :  null);
        exit;
    }
}
