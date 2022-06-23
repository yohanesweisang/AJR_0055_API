<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\Driver;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();

        if(count($drivers) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Empty',
            'data' => null
        ], 400);
    }

    public function show($id_driver)
    {
        $drivers = Driver::where('id_driver', '=', $id_driver)->first();

        if(!is_null($drivers)){
            return response([
                'message' => 'Retrieve Driver Success',
                'data' => $drivers
            ], 200);
        }

        return response([
            'message' => 'Driver Not Found',
            'data' => null
        ], 404);
    }

    // public function store(Request $request)
    // {
    //     $storeData = $request->all();
    //     $validate = Validator::make($storeData, [
    //         'nama_kelas' => 'required|max:60|unique:drivers',
    //         'kode' => 'required',
    //         'biaya_pendaftaran' => 'required|numeric',
    //         'kapasitas' => 'required|numeric'
    //     ]);

    //     if($validate->fails())
    //         return response(['message' => $validate->errors()], 400);
        
    //     $driver = Driver::create($storeData);
    //     return response([
    //         'message' => 'Add Driver Success',
    //         'data' => $driver
    //     ], 200);
    // }

    // public function destroy($id)
    // {
    //     $driver = Driver::find($id);

    //     if(is_null($driver)){
    //         return response([
    //             'message' => 'Driver Not Found',
    //             'data' => null
    //         ], 404);
    //     }

    //     if($driver->delete()){
    //         return response([
    //             'message' => 'Delete Driver Success',
    //             'data' => $driver
    //         ], 200);
    //     }

    //     return response([
    //         'message' => 'Delete Driver Failed',
    //         'data' => null
    //     ], 400);
    // }

    public function update(Request $request, $id)
    {
        $drivers = Driver::where('id_driver', '=', $id_driver)->first();

        if(is_null($driver)){
            return response([
                'message' => 'Driver Not Found',
                'data' => null
            ], 404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'status' => 'required'
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()], 400);

        $driver->kapasitas = $updateData['kapasitas'];

        if($driver->save()) {
            return response([
                'message' => 'Update Driver Success',
                'data' => $driver
            ], 200);
        }
        return response([
            'message' => 'Update Driver Failed',
            'data' => null,
        ], 400);
    }
}
