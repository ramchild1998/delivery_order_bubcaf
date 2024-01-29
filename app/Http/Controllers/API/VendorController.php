<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Master\Vendor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;


class VendorController extends BaseController
{
    public function index(Request $request)
    {
        $vendors = Vendor::all();
        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Data vendor berhasil diambil.',
                'data' => $vendors
            ], 200);
        }
        return view('master.vendor.index', compact('vendors'));
    }

    public function create()
    {
        return view('master.vendor.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pic_name' => 'required',
            'pic_contact_num' => 'required',
        ]);
    
        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan!',
                    'data' => $validator->errors()
                ], 400);
            } else {
                return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
            }
        }
    
        $existingVendor = Vendor::where('name', $request->input('name'))
            ->where('pic_name', $request->input('pic_name'))
            ->where('pic_contact_num', $request->input('pic_contact_num'))
            ->first();
    
        if ($existingVendor) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data sudah ada!',
                    'data' => ['vendor' => $existingVendor->toArray()]
                ], 400);
            } else {
                return $this->sendError('Data sudah ada!', ['vendor' => $existingVendor->toArray()], 400);
            }
        }
    
        $vendor = new Vendor();
        $vendor->name = $request->input('name');
        $vendor->pic_name = $request->input('pic_name');
        $vendor->pic_contact_num = $request->input('pic_contact_num');
        $vendor->is_active = true; // Set is_active to true
        $vendor->save();
    
        if ($vendor) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'data' => ['vendor' => $vendor->toArray(), 'status' => 'success'],
                    'message' => 'Vendor berhasil ditambahkan.'
                ], 200);
            } else {
                Session::flash('success', 'Vendor berhasil ditambahkan.');
                return redirect()->route('vendor.index');
                
            }
        } else {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'data' => ['status' => 'failure'],
                    'message' => 'Gagal menambahkan vendor.'
                ], 400);
            } else {
                Session::flash('error', 'Gagal menambahkan vendor.');
                return $this->sendResponse(['status' => 'failure'], 'Gagal menambahkan vendor.');
            }
        }
    }
    

    public function show(string $id)
    {
        $vendor = Vendor::find($id);

        if (is_null($vendor)) {
            return $this->sendError('User tidak ditemukan.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Data user ditemukan.',
            'data' => $vendor
        ], 200);
    }

    public function update(Request $request, Vendor $vendor)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'pic_name' => 'required',
            'pic_contact_num' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan pada validasi!', $validator->errors(), 400);
        }

        if ($request->input('name') !== $vendor->name ||
            $request->input('pic_name') !== $vendor->pic_name ||
            $request->input('pic_contact_num') !== $vendor->pic_contact_num) {

            $vendor->name = $request->input('name');
            $vendor->pic_name = $request->input('pic_name');
            $vendor->pic_contact_num = $request->input('pic_contact_num');
            $vendor->is_active = $request->input('is_active', $vendor->is_active); // Preserve existing value if not provided
            $vendor->save();

            return $this->sendResponse($vendor->toArray(), 'Data vendor berhasil diperbarui.');
        }
        return $this->sendError('Data vendor tidak dapat diupdate!', ['vendor' => $vendor->toArray()], 400);
    }

    public function search(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $name = $request->input('name');
        $vendors = Vendor::where('name', 'LIKE', '%' . $name . '%')->get();

        return $this->sendResponse($vendors->toArray(), 'Data vendor berhasil ditemukan.');
    }

    public function destroy($id)
    {
        $vendor = Vendor::find($id);

        if (is_null($vendor)) {
            return $this->sendError('Vendor tidak ditemukan.');
        }

        $vendor->delete();

        return $this->sendResponse([], 'Vendor berhasil dihapus.');
    }
}