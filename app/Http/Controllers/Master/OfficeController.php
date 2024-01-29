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
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Alert;
use Illuminate\Support\Facades\Validator;


class OfficeController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offices = Office::with('vendor','province','city','subdistrict','village')->latest()->get();

        return view('master.office.index', compact('offices'));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create(Office $office)
    {
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        $vendors = Vendor::all();
        $selectedProvinceId = ($office->province_id);
        $selectedCityId = ($office->city_id);
        $selectedSubId = ($office->subdistrict_id);
        $selectedVillId = ($office->village_id);
        return view('master.office.create', compact('vendors', 'city', 'province', 'subdistrict', 'village', 'selectedProvinceId', 'selectedCityId', 'selectedSubId', 'selectedVillId'));
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
        $selectedProvinceId = ($office->province_id);
        return view('master.office.show', compact('office','selectedProvinceId'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Office $office)
    {
        // Eager load
        $office = Office::findOrFail($office->id);
        $vendors = Vendor::orderBy('name', 'asc')->get();
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        $vendors = Vendor::all();
        $selectedProvinceId = ($office->province_id);
        $selectedCityId = ($office->city_id);
        $selectedSubId = ($office->subdistrict_id);
        $selectedVillId = ($office->village_id);
        return view('master.office.edit', compact('office','selectedProvinceId' ,'selectedCityId','selectedSubId','selectedVillId','vendors','province','city','subdistrict','village'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $office = Office::find($id);

        if (is_null($office)) {
            return $this->sendError('Office tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'vendor_id' => 'required' . $id,
        ]);


        $input = $request->all();
        $input['pic_name'] = $request->input('pic_name');
        $input['pic_contact_name'] = $request->input('pic_contact_name');
        $input['is_active'] = $request->is_active == 'true' ? true : false;
        $office->update($input);

        // if ($user->username === $input['username'] && $user->email === $input['email']) {
        //     return $this->sendError('Data sudah ada atau sama dengan data lain dari database.');
        // }

        if($request->wantsJson()){
            return  response()->json([
                'message'=>'Office berhasil diperbarui',
            ], 200);
        }
        Alert::success('OK!', 'Updated Successfully');
        return redirect()->route('office.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Office $office)
    {
        //
    }

    public function fetchCities(Request $request)
    {
        $provinceId = $request->input('province_id');
        $cities = City::where('province_id', $provinceId)->get();

        return response()->json([
            'cities' => $cities
        ]);
    }

    public function fetchSubdistricts(Request $request)
    {
        $cityId = $request->input('city_id');
        $subdistricts = Subdistrict::where('city_id', $cityId)->get();

        return response()->json([
            'subdistricts' => $subdistricts
        ]);
    }

    public function fetchVillages(Request $request)
    {
        $subdistrictId = $request->input('subdistrict_id');
        $villages = Village::where('subdistrict_id', $subdistrictId)->get();

        return response()->json([
            'villages' => $villages
        ]);
    }


}
