<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;
use App\Models\Setting\Parameter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParameterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parameter = Parameter::where('is_active', '1')
        ->orderBy('param_name')
        ->get();    
        return view('settings.parameter.index', compact('parameter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('settings.parameter.create', compact('parameter'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->type = $request->type;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->vendor_id = $request->vendor_id;
        $user->office_id = $request->office_id;
        $user->contact_number = $request->contact_number;
        $user->role_type = $request->role_type;
        $user->is_active = $request->is_active ?? true;
        $user->save();
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    // public function edit(User $user)
    // {
    //     $vendors = Vendor::all();
    //     $offices = Office::all();
    //     $role = Role::all();
    //     return view('settings.user.edit', compact('user','vendors','offices','role'));
    // }

    public function edit($id)
    {
        $parameter = Parameter::findorfail($id);
        $param_name = $parameter->param_name;
        $param_history = Parameter::where('param_name', $param_name)
        ->leftJoin('users', 'parameters.user_id', '=', 'users.id')
        ->select('parameters.*', 'users.name as user_name')
        ->orderBy('updated_at', 'desc')
        ->get();
        $nilai_aktif;
        $activeParameters = Parameter::where('param_name', $param_name)->where('is_active', 1)->get();
        foreach ($activeParameters as $param) {
            $nilai_aktif = $param->nilai;
        }
        
        return view('settings.parameter.edit', compact('parameter','nilai_aktif', 'param_history'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Parameter $parameter)
    {

        $currentUserId = Auth::id();
        $existingParameter = Parameter::where('param_name', $parameter->param_name)
        ->where('is_active', 1)
        ->first();
    
    if ($existingParameter) {
        $existingParameter->is_active = 0;
        $existingParameter->save();
    }

        $parameter = new Parameter;
        $parameter->param_name = $existingParameter->param_name;
        $parameter->user_id = $currentUserId;
        $parameter->nilai = $request->nilai;
        $parameter->is_active = 1;
        $parameter->save();

        return redirect()->route('parameter.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
