<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\Office;
use App\Models\Master\Vendor;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Subdistrict;
use App\Models\Location\Village;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;

class OfficeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = DB::table('offices')
        ->join('vendors', 'offices.vendor_id', '=', 'vendors.id')
        ->join('village', 'offices.village_id', '=', 'village.id')
        ->join('subdistrict', 'offices.subdistrict_id', '=', 'subdistrict.id')
        ->join('city', 'offices.city_id', '=', 'city.id')
        ->join('province', 'offices.province_id', '=', 'province.id')
        ->select('offices.*','vendors.name as vendor_name' ,'village.name as village_name', 'subdistrict.name as subdistrict_name', 'city.name as city_name', 'province.name as province_name')
        ->get();
        return view('master.office.index', compact('offices'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        $vendors = Vendor::all();
    
        return view('master.office.create', compact('vendors', 'city', 'province', 'subdistrict', 'village'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $office = new Office();
        $office->name = $request->name;
        $office->vendor_id = $request->vendor_id;
        $office->address = $request->address;
        $office->province_id = $request->province_id;
        $office->city_id = $request->city_id;
        $office->subdistrict_id = $request->subdistrict_id;
        $office->village_id = $request->village_id;
        $office->zip_code = $request->zip_code;
        $office->pic_name = $request->pic_name;
        $office->pic_contact_number = $request->pic_contact_number; 
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
        // Eager load
        $office = Office::with('vendors', 'city', 'province', 'subdistrict', 'village')->findOrFail($office->id);
        // $province = Province::find($provinceId);
        // $cities = $province->cities;
        
        // $city = City::find($cityId);
        // $subdistricts = $city->subdistricts;
        
        // $subdistrict = Subdistrict::find($subdistrictId);
        // $villages = $subdistrict->villages;
        
        // Lazy load
        // $office->load('vendors', 'city', 'province', 'subdistrict', 'village');

        $vendors = Vendor::orderBy('name', 'asc')->get();

        return view('master.office.edit', compact('office', 'vendors'));
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
