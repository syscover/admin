<?php namespace Syscover\Admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Syscover\Core\Controllers\CoreController;
use Syscover\Admin\Models\Test;

class TestController extends CoreController
{
    protected $model = Test::class;

    public function testCreate(Request $request){
        $object = Test::create([
            'name' => 'hello word',
            'data' => [
                'data' => 'miguel',
                'price' => 40.52
            ]
        ]);

        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }

    public function test(Request $request){
        $objects = Test::all();

        $response['status'] = "success";
        $response['data']   = $objects;

        return response()->json($response);
    }

    public function testUpdate(Request $request){


        $object = Test::find(3);

        dd($object->data);



        $response['status'] = "success";
        $response['data']   = $object;

        return response()->json($response);
    }
}
