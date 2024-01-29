<?php

namespace App\Http\Controllers\API;

use Alert;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Master\Vendor;
use App\Models\Master\Office;
use App\Models\Setting\Role;
use Illuminate\Support\Facades\Validator;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::join('vendors', 'users.vendor_id', '=', 'vendors.id')
        ->join('offices', 'users.office_id', '=', 'offices.id')
        ->join('roles', 'users.role_id', '=', 'roles.id')
        ->select('users.*', 'vendors.name as vendor_name', 'offices.name as office_name', 'roles.name as role_name')
        ->get();
    
        return view('settings.user.index', compact('users'));;
    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan tampilan atau respons yang sesuai untuk formulir pembuatan user
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Terjadi Kesalahan!');
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $input = $request->all();
        $input['contact_number'] = $request->input('contact_number');
        $input['password'] = bcrypt($input['password']);
        $input['is_active'] = true;

        $user = User::create($input);
        $success['token'] = $user->createToken('user_token')->plainTextToken; // Token Sanctum (Login)
        $success['name'] = $user->name;

        if($request->wantsJson()){
            return  response()->json([
                'message'=>'User berhasil ditambahkan',
                'is_logged_in' => $users->is_logged_in,
                'data'=>$success,

            ], 200);
        }
        Alert::success('OK!', 'Added Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User tidak ditemukan.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Data user ditemukan.',
            'data' => $user
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tampilkan tampilan atau respons yang sesuai untuk formulir edit user
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User tidak ditemukan.');
        }

        // Tampilkan tampilan atau respons yang sesuai untuk formulir edit user
        $user = User::findorfail($id);
        $vendors = Vendor::all();
        $offices = Office::all();
        $role = Role::all();
        return view('settings.user.edit', compact('user','vendors','offices','role', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        

        $users = User::find($id);

        if (is_null($users)) {
            return $this->sendError('User tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            // 'password' => 'required',
            // 'c_password' => 'required|same:password',
            // 'is_active' => 'boolean',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Terjadi kesalahan!');
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }
        $input = $request->all();
        $input['contact_number'] = $request->input('contact_number');
        // Check if the password needs to be updated
        if (!empty($input['password'])) {
            $input['password'] = bcrypt($input['password']);
        } else {
            unset($input['password']); // Remove the password field from the input if not updating
        }

        $input['is_active'] = $request->is_active == 'true' ? true : false;
        $users->update($input);

        // if ($user->username === $input['username'] && $user->email === $input['email']) {
        //     return $this->sendError('Data sudah ada atau sama dengan data lain dari database.');
        // }

        if($request->wantsJson()){
            return  response()->json([
                'message'=>'User berhasil diperbarui',
                'is_logged_in' => $users->is_logged_in,

            ], 200);
        }
        Alert::success('OK!', 'Updated Successfully');
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User tidak ditemukan.');
        }

        $user->delete();

        return $this->sendResponse([], 'User berhasil dihapus.');
    }
    public function fetchOffices(Request $request) {
            $vendorId = $request->input('vendor_id');
            $offices = Office::where('vendor_id', $vendorId)->get();

            return response()->json(['offices' => $offices]);
    }

    public function export()
    {
        if($request->wantsJson()){
            return  response()->json([
                'message'=>'user export success',
                'data' => $users,

            ], 200);
        }
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}
