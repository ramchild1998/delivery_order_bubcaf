<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Models\Setting\Role;
use Illuminate\Support\Facades\Validator;

class RoleController extends BaseController
{
    public function index()
    {
        $roles = Role::all();

        return $this->sendResponse($roles->toArray(), 'Data role berhasil diambil.');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $existingRole = Role::where('name', $request->input('name'))->first();

        if ($existingRole) {
            return $this->sendError('Data sudah ada!', ['role' => $existingRole->toArray()], 400);
        }

        $role = new Role();
        $role->name = $request->input('name');
        $role->is_active = true;
        $role->save();

        if ($role) {
            return $this->sendResponse(['role' => $role->toArray(), 'status' => 'success'], 'Role berhasil ditambahkan.');
        } else {
            return $this->sendResponse(['status' => 'failure'], 'Gagal menambahkan role.');
        }
    }

    public function show(string $id)
    {
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError('Role tidak ditemukan.');
        }

        return response()->json([
            'success' => true,
            'message' => 'Data role ditemukan.',
            'data' => $role
        ], 200);
    }

    public function update(Request $request, Role $role)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->sendError('Terjadi kesalahan!', $validator->errors(), 400);
        }

        $existingRole = Role::where('name', $request->input('name'))
            ->where('id', '!=', $role->id)
            ->first();

        if ($existingRole) {
            return $this->sendError('Data sudah ada!', ['role' => $existingRole->toArray()], 400);
        }

        $role->name = $request->input('name');
        $role->save();

        return $this->sendResponse($role->toArray(), 'Role berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (is_null($role)) {
            return $this->sendError('Role tidak ditemukan.');
        }

        $role->delete();

        return $this->sendResponse([], 'Role berhasil dihapus.');
    }
}