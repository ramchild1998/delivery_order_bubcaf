<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vendors = Vendor::latest()->get();
        return view('master.vendor.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('master.vendor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $vendor = new Vendor();
        $vendor->name = $request->name;
        $vendor->pic_name = $request->pic_name;
        $vendor->pic_contact_num = $request->pic_contact_num; 
        $vendor->is_active = $request->is_active ?? true;
        $vendor->save();
        return redirect()->route('vendor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('master.vendor.show', compact('vendor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        return view('master.vendor.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        $vendor->name = $request->name;
        $vendor->is_active = $request->is_active == 'true' ? true : false;
        $vendor->save();
        return redirect()->route('vendors.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        // Hapus data dari database
        $vendor->delete();

        // Redirect ke halaman index
        return redirect()->route('vendor.index');
    }
}