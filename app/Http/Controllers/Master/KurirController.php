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
use DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Alert;
use Illuminate\Support\Facades\Validator;


class KurirController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $kurirs = Kurir::with('vendor','office','province','city','subdistrict','village')->latest()->get();
        return view('master.kurir.index', compact('kurirs'));

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
        return view('master.kurir.create', compact('office','vendors','province','city','subdistrict','village'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kurirs = new Kurir();
        $kurirs->nik = $request->nik;
        $kurirs->name = $request->name;
        $kurirs->vendor_id = $request->vendor_id;
        $kurirs->office_id = $request->office_id;
        $kurirs->province_id = $request->province_id;
        $kurirs->city_id = $request->city_id;
        $kurirs->subdistrict_id = $request->subdistrict_id;
        $kurirs->village_id = $request->village_id;
        $kurirs->plat_number = $request->plat_number;
        $kurirs->no_hp = $request->no_hp;
        $kurirs->address = $request->address; 
        $kurirs->zip_code = $request->zip_code; 
        $fileName = time().$request->file('foto')->getClientOriginalName();
        $path = $request->file('foto')->storeAs('images',$fileName,'public');
        $requestData["foto"] = '/storage/'.$path;
        $kurirs->foto = $requestData["foto"];
        $kurirs->is_active = $request->is_active ?? true;
        $kurirs->save();
        return redirect()->route('kurir.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        return view('master.kurir.show', compact('kurir'));
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kurir $kurir)
    {
        $kurir = Kurir::findOrFail($kurir->id);
        $vendors = Vendor::orderBy('name', 'asc')->get();
        $office = Office::all();
        $city = City::all();
        $province = Province::all();
        $subdistrict = Subdistrict::all();
        $village = Village::all();
        $vendors = Vendor::all();
        $selectedProvinceId = ($kurir->province_id);
        $selectedCityId = ($kurir->city_id);
        $selectedSubId = ($kurir->subdistrict_id);
        $selectedVillId = ($kurir->village_id);

        return view('master.kurir.edit', compact('kurir','office', 'vendors','province','city','subdistrict','village','selectedProvinceId', 'selectedCityId', 'selectedSubId', 'selectedVillId'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $kurir = Kurir::find($id);

        if (is_null($kurir)) {
            return $this->sendError('Office tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'nik' => 'required',
            'name' => 'required',
            'vendor_id' => 'required',
            'office_id' => 'required',
        ]);


        $input = $request->all();
        $input['province_id'] = $request->input('province_id');
        $input['city_id'] = $request->input('city_id');
        $input['subdistrict_id'] = $request->input('subdistrict_id');
        $input['village_id'] = $request->input('village_id');
        $input['plat_number'] = $request->input('plat_number');
        $input['no_hp'] = $request->input('no_hp');
        $input['address'] = $request->input('address');
        $input['zip_code'] = $request->input('zip_code');
        $input['is_active'] = true ?? $kurir->is_active;
        if ($request->hasFile('foto')) {
            $fileName = time() . $request->file('foto')->getClientOriginalName();
            $path = $request->file('foto')->storeAs('images', $fileName, 'public');
        }
        $input['foto'] =  $request->file('foto')->storeAs('storage/images', $fileName, 'public');
        $kurir->update($input);

        // if ($user->username === $input['username'] && $user->email === $input['email']) {
        //     return $this->sendError('Data sudah ada atau sama dengan data lain dari database.');
        // }

        if($request->wantsJson()){
            return  response()->json([
                'message'=>'Office berhasil diperbarui',
            ], 200);
        }
        Alert::success('OK!', 'Updated Successfully');
        return redirect()->route('kurir.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kurir $kurir)
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

    public function fetchOffices(Request $request) {
        $vendorId = $request->input('vendor_id');
        $offices = Office::where('vendor_id', $vendorId)->get();

        return response()->json(['offices' => $offices]);
}

}
