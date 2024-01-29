<?php

namespace App\Http\Controllers\Utilities;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\Kurir;
use App\Models\Utilities\Device;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Alert;



use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DeviceController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $device = Device::with('kurir')->latest()->get();
        return view('utilities.device.index', compact('device'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kurir = Kurir::all();
        return view('utilities.device.create', compact('kurir'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $device = new Device();
        $device->kurir_id = $request->kurir_id;
        $device->device_id = $request->device_id;
        $device->merk = $request->merk;
        $device->type = $request->type;
        $device->is_active = $request->is_active ?? true;
        $device->save();
        return redirect()->route('device.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    public function edit(Device $device)
    {   
        $device = Device::findorfail($device->id);
        $selectedKurirId = ($device->kurir_id);
        $kurir = Kurir::all();
        return view('utilities.device.edit', compact('device','kurir','selectedKurirId'));
        dd($device->is_active);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {


        $device = Device::find($id);

        if (is_null($device)) {
            return $this->sendError('Device tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'kurir_id' => 'required',
            'imei' => 'required' . $id,
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Terjadi kesalahan!');
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }
        $input = $request->all();
        $input['merk'] = $request->input('merk');
        $input['type'] = $request->input('type');
        $input['is_active'] = $request->is_active == 'true' ? true : false;
        $device->update($input);

        // if ($user->username === $input['username'] && $user->email === $input['email']) {
        //     return $this->sendError('Data sudah ada atau sama dengan data lain dari database.');
        // }

        if($request->wantsJson()){
            return  response()->json([
                'message'=>'Device berhasil diperbarui',
            ], 200);
        }
        
        Alert::success('OK!', 'Updated Successfully');
        return redirect()->route('device.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}