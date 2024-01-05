<?php

namespace App\Http\Controllers;

  
use Illuminate\Http\Request;
use App\Models\Location\City;
use App\Models\Location\Province;
use App\Models\Location\Subdistrict;
use App\Models\Location\Village;

class DropdownController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        $data['province'] = Country::get(["name", "id"]);
        return view('master.office.edit', $data);
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function fetchCity(Request $request)
    {
        $data['city'] = State::where("city_id", $request->city_id)
                                ->get(["name", "id"]);
        return response()->json($data);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function fetchSubdistrict(Request $request)
    {
        $data['subdistrict'] = City::where("subdistrict_id", $request->subdistrict_id)
                                    ->get(["name", "id"]);
        return response()->json($data);
    }

    public function fetchVillage(Request $request)
    {
        $data['village'] = City::where("village_id", $request->village_id)
                                    ->get(["name", "id"]);
        return response()->json($data);
    }

}