<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();

        return $this->sendResponse($users, 'Data users berhasil diambil.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tampilkan tampilan atau respons yang sesuai untuk formulir pembuatan user
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user = User::create($input);

        return $this->sendResponse($user, 'User berhasil ditambahkan.');
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

        return $this->sendResponse($user, 'Data user berhasil ditemukan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Tampilkan tampilan atau respons yang sesuai untuk formulir edit user
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);

        if (is_null($user)) {
            return $this->sendError('User tidak ditemukan.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);

        $user->update($input);

        return $this->sendResponse($user, 'User berhasil diperbarui.');
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

    // /**
    //  * Activate the specified user account.
    //  */
    // public function activate(string $id)
    // {
    //     $user = User::find($id);

    //     if (is_null($user)) {
    //         return $this->sendError('User tidak ditemukan.');
    //     }

    //     $user->is_active = true;
    //     $user->save();

    //     return $this->sendResponse($user, 'User berhasil diaktifkan.');
    // }

    // /**
    //  * Deactivate the specified user account.
    //  */
    // public function deactivate(string $id)
    // {
    //     $user = User::find($id);

    //     if (is_null($user)) {
    //         return $this->sendError('User tidak ditemukan.');
    //     }

    //     $user->is_active = false;
    //     $user->save();

    //     return $this->sendResponse($user, 'User berhasil dinonaktifkan.');
    // }
}