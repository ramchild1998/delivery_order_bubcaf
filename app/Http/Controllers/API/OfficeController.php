<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Master\Office;
use App\Models\Master\Vendor;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Subdistrict;
use App\Models\Location\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::latest()->get();

        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Data Office berhasil ditambahkan!',
                'data' => $offices
            ]);
        }
        return view('master.office.index',compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        return view('master.office.create', compact('vendors','city','province','subdistrict','village'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $office = new Office();
        $office->name = $request->name;
        $office->vendor_id = $request->vendor_id;
        $office->pic_contact_num = $request->pic_contact_num; 
        $office->is_active = $request->is_active ?? true;
        $office->save();
        return redirect()->route('office.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Office $office)
    {
        return view('master.office.show', compact('office'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {   
        $vendors = Vendor::all();
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        return view('master.office.edit', compact('vendors','office','city','province','subdistrict','village'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Office $office)
    {
        $office->name = $request->name;
        $office->is_active = $request->is_active == 'true' ? true : false;
        $office->save();
        return redirect()->route('office.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }
}
