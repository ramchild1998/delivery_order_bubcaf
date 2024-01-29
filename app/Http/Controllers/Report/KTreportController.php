<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Master\Kurir;
use App\Models\Utilities\Device;
use Illuminate\Support\Facades\Crypt;



use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KTreportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $device = Device::with('kurir')->latest()->get();
        return view('report.kt.index', compact('device'));
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