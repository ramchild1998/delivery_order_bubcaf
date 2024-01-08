<?php

namespace App\Http\Controllers\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Master\Vendor;
use App\Models\Master\Office;
use App\Models\Setting\Role;



use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = DB::table('users')
            ->join('vendors', 'users.vendor_id', '=', 'vendors.id')
            ->join('offices', 'users.office_id', '=', 'offices.id')
            ->join('roles', 'users.role_type', '=', 'roles.id')
            ->select('users.*', 'vendors.name as vendor_name', 'offices.name as office_name','roles.name as role_type')
            ->get();
        return view('settings.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendors = Vendor::all();
        $offices = Office::all();
        $role = Role::all();
        return view('settings.user.create', compact('vendors','offices','role'));
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
        $user = User::findorfail($id);
        $vendors = Vendor::all();
        $offices = Office::all();
        $role = Role::all();
        return view('settings.user.edit', compact('user','vendors','offices','role', 'id'));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        // // Validasi Data User untuk Registrasi
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required',
        //     'name' => 'required',
        //     'email' => 'required|email|unique:users,email,'.$user->id,
        //     'password' => 'required',
        //     'c_password' => 'required|same:password',
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Terjadi kesalahan!',
        //         'data' => $validator->errors()
        //     ]);
        // }

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $input['is_active'] = true;

        // $user->fill($input);
        $user->type = $request->type;
        $user->vendor_id = $request->vendor_id;
        $user->office_id = $request->office_id;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->contact_number = $request->contact_number;
        $user->role_id = $request->role_id;
        $user->is_active = $request->is_active == 'true' ? true : false;
        if (!$request->has('is_active')) {
            $user->is_active = old('is_active', $user->is_active);
        }
            
        $user->save();

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}