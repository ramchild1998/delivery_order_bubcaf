<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Models\Master\Vendor;
use Illuminate\Support\Facades\Validator;

class VendorController extends BaseController
{
    private $vendor;

    public function __construct(Vendor $vendor)
    {
        $this->vendor = $vendor;
    }

    protected function validateVendorData(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'pic_name' => 'required|string',
            'pic_contact_num' => 'required|string',
        ]);

        return $validator;
    }

    public function getDataVendor()
    {
        $vendors = Vendor::all();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Vendors retrieved successfully',
                'data' => $vendors
            ], 200);
        }

        return view('vendors')->with('vendors', $vendors);
    }

    public function insertVendor(Request $request)
    {
        $validator = $this->validateVendorData($request);

        if ($validator->fails()) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan!',
                    'data' => $validator->errors()
                ]);
            }

            return view('insert_vendor')->withErrors($validator);
        }

        $existingVendor = $this->vendor->where('name', $request->name)->first();

        if ($existingVendor) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor sudah ada, Silahkan cek kembali!',
                    'data' => null
                ]);
            }

            return view('vendor_already_exists');
        }

        $newVendor = $this->vendor->create([
            'name' => $request->name,
            'pic_name' => $request->pic_name,
            'pic_contact_num' => $request->pic_contact_num
        ]);

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Vendor berhasil ditambahkan!',
                'data' => $newVendor
            ]);
        }

        return view('insert_vendor_success')->with('vendor', $newVendor);
    }

    public function updateVendor(Request $request)
    {
        $id = $request->query('id');
        $vendor = Vendor::find($id);

        if (!$vendor) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor tidak ditemukan!',
                    'data' => null
                ], 404);
            }
            return view('vendor_not_found');
        }

        $validator = $this->validateVendorData($request);

        if ($validator->fails()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan!',
                    'data' => $validator->errors()
                ]);
            }
            return view('update_vendor')->withErrors($validator);
        }

        $vendor->name = $request->name;
        $vendor->pic_name = $request->pic_name;
        $vendor->pic_contact_num = $request->pic_contact_num;
        $vendor->is_active = $request->is_active;
        $vendor->save();

        if ($request->wantsJson()) {

            return response()->json([
                'success' => true,
                'message' => 'Vendor berhasil diperbarui!',
                'data' => $vendor
            ]);
        } else {

            return view('update_vendor_success')->with('vendor', $vendor);
        }
    }
    public function detailVendor(Request $request)
    {
        $id = $request->query('id');
        $vendor = Vendor::find($id);

        if (!$vendor) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor tidak ditemukan!',
                    'data' => null
                ], 404);
            }

            return view('vendor_not_found');
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Vendor berhasil ditemukan berdasarkan {id}!',
                'data' => $vendor
            ], 200);
        }

        return view('vendor_detail')->with('vendor', $vendor);
    }

    public function deleteVendor()
    {
        $id = request()->query('id');
        $vendor = Vendor::find($id);

        if (!$vendor) {
            if (request()->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Vendor tidak ditemukan!',
                    'data' => null
                ]);
            }

            return view('vendor_not_found');
        }

        $vendor->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Vendor berhasil dihapus!',
                'data' => null
            ]);
        }

        return view('delete_vendor_success');
    }
}