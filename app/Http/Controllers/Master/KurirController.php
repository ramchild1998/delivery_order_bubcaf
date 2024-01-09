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



class KurirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $kurirs =DB::table('kurirs as a')
        ->leftJoin('vendors as b', 'a.vendor_id', '=', 'b.id')
        ->leftJoin('offices as c', 'a.office_id', '=', 'c.id')
        ->leftJoin('province as d', 'a.province_id', '=', 'd.id')
        ->leftJoin('city as e', 'a.city_id', '=', 'e.id')
        ->leftJoin('subdistrict as f', 'a.subdistrict_id', '=', 'f.id')
        ->leftJoin('village as g', 'a.village_id', '=', 'g.id')
        ->select('a.*', 'b.name as vendor_name', 'c.name as office_name', 'd.name as province_name', 'e.name as city_name', 'f.name as sub_name', 'g.name as village_name')
        ->get();
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
