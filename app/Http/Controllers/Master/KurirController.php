<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Kurir;
use App\Models\Master\Office;
use App\Models\Master\Vendor;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Subdistrict;
use App\Models\Location\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kurirs = Kurir::latest()->get();
        return view('master.kurir.index',compact('kurirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $office = Office::all();
        $vendors = Vendor::all();
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        return view('master.kurir.create', compact('office','vendors','city','province','subdistrict','village'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kurirs = new Kurir();
        $kurirs->name = $request->name;
        $kurirs->vendor_id = $request->vendor_id;
        $kurirs->pic_contact_num = $request->pic_contact_num; 
        $kurirs->is_active = $request->is_active ?? true;
        $kurirs->save();
        return redirect()->route('kurir.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }
}
