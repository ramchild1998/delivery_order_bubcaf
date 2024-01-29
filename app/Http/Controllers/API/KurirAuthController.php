<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;

class KurirAuthController extends BaseController
{
    use HasApiTokens;

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        // Sesuaikan logika login untuk Kurir
        $kurir = User::where('email', $credentials['email'])->first();

        if (!$kurir || !Auth::attempt($credentials)) {
            return $this->sendError('Whoops! Email atau kata sandi anda salah!', null, 401);
        }

        // Check if Kurir is active
        if (!$kurir->is_active || $kurir->role_id !== 3) {
            return $this->sendError('Akun tidak valid atau tidak memiliki akses, pastikan anda adalah kurir!', null, 401);
        }

        $token = $kurir->createToken('kurir_token')->plainTextToken;

        // Check if Kurir is already logged in
        if ($kurir->is_logged_in) {
            return $this->sendError('Anda sudah login di tempat lain. Harap logout terlebih dahulu!', [
                'token' => $token, // Data Sementara selama DEV, Perlu dihapus jika di release!
                'name' => $kurir->name,
                'is_logged_in' => $kurir->is_logged_in,
            ], 401);
        }

        $kurir->last_login_at = $kurir->current_login_at ?? now();
        $kurir->current_login_at = now();
        $kurir->is_logged_in = true;
        $kurir->save();

        // Revoke all tokens except the current one
        if ($kurir->currentAccessToken()) {
            DB::table('personal_access_tokens')
                ->where('tokenable_id', $kurir->id)
                ->where('id', '!=', $kurir->currentAccessToken()->id)
                ->delete();
        }

        $response = [
            'token' => $token,
            'name' => $kurir->name,
            'role_id' => $kurir->role_id,
            'type' => $kurir->type,
            'is_logged_in' => $kurir->is_logged_in,
            'last_login_at' => $kurir->last_login_at,
            'current_login_at' => $kurir->current_login_at,
        ];

        return $this->sendResponse($response, 'Login Kurir Berhasil!', null, 200);
    }

    public function logout(Request $request): JsonResponse
    {
        $kurir = Auth::user();

        // Revoke the Kurir's access tokens
        DB::table('personal_access_tokens')
            ->where('tokenable_id', $kurir->id)
            ->delete();

        // Update last_active_at to indicate the Kurir is no longer active
        $kurir->update([
            'last_login_at' => null,

            'is_logged_in' => false, // Set is_logged_in to false
        ]);

        return $this->sendResponse([
            'is_logged_in' => $kurir->is_logged_in
        ], 'Logout Kurir Berhasil. Tokens telah direvoke.', null, 200);
    }
}
