<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\JobOrder\Pickup;
use App\Models\Utilities\Device;
use Illuminate\Support\Facades\Crypt;



use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DRreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $delivered = DB::table('pickup as a')
            ->select('a.*', 'b.name as kurir_name', 'c.time_start as time_start', 'c.time_end as time_end')
            ->leftJoin(DB::raw('(select b.id, b.name from kurirs b) as b'), 'b.id', '=', 'a.kurir_id')
            ->leftJoin(DB::raw('(select c.status, c.pick_up_id, c.time_start, c.time_end from pickup_detail c) as c'), 'c.pick_up_id', '=', 'a.id')
            ->where('a.status', 'Done')
            ->where('c.status', 'Done')
            ->get();
    
        return view('report.dr.index', compact('delivered'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    public function edit(Report $report)
    {   

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}