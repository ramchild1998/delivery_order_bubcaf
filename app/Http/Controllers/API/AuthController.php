<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\User;
use illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

class AuthController extends BaseController
{
    use HasApiTokens, AuthorizesRequests, ValidatesRequests;
    public function register(request $request): JsonResponse
    {
        // Validasi Data User untuk Registrasi
        $validator = Validator::make($request->all(),
        [
            'username' => 'required',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan!',
                'data' => $validator->errors()
            ]);
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['is_active'] = true;

        $user = User::create($input);
        $success['token'] = $user->createToken('user_token')->plainTextToken; // Token Sanctum (Login)
        $success['name'] = $user->name;

        return response()->json([
            'success' => true,
            'message' => 'Registrasi Berhasil!',
            'data' => $success
        ], 200);

    }

    // Fungsi Login
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');
    
        $user = User::where('email', $credentials['email'])->first();
    
        if (!$user || !Auth::attempt($credentials)) {
            return response()->json([
                'success' => false,
                'message' => 'Whoops! Email atau kata sandi anda salah!',
                'data' => null
            ]);
        }
    
        // Check if user is active
        if (!$user->is_active) {
            return response()->json([
                'success' => false,
                'message' => 'Mohon maaf akun anda belum aktif. Silahkan kontak admin!',
                'data' => null
            ]);
        }
    
        $token = $user->createToken('user_token')->plainTextToken;
        // Check if user is already logged in
        if ($user->is_logged_in) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah login di tempat lain. Harap logout terlebih dahulu!',
                'data' => [
                    'token' => $token, //Data Sementara selama DEV, Perlu dihapus jika di release!
                    'name' => $user->name,
                    'last_login_at' => $user->last_login_at,
                    'current_login_at' => $user->current_login_at,
                ]
            ]);
        }
    
        $user->last_login_at = $user->current_login_at ?? now();
        $user->current_login_at = now();
        $user->is_logged_in = true;
        $user->save();
    
        // Revoke all tokens except the current one
        if ($user->currentAccessToken()) {
            DB::table('personal_access_tokens')
                ->where('tokenable_id', $user->id)
                ->where('id', '!=', $user->currentAccessToken()->id)
                ->delete();
        }
    
        $token = $user->createToken('user_token')->plainTextToken;
    
        $response = [
            'success' => true,
            'message' => 'Login successful!',
            'data' => [
                'token' => $token,
                'name' => $user->name,
                'last_login_at' => $user->last_login_at,
                'current_login_at' => $user->current_login_at,
            ]
        ];
    
        return response()->json($response);
    }
    
    // Updated on 09.19 AM 9 Jan 2024
    // Fungsi Logout
    public function logout(Request $request)
    {
        $user = Auth::user();
    
        // Revoke the user's access tokens
        DB::table('personal_access_tokens')
            ->where('tokenable_id', $user->id)
            ->delete();
    
        // Update last_active_at to indicate the user is no longer active
        $user->update(['last_login_at' => null]);
    
        if ($request->wantsJson()) {
            return response()->json(['message' => 'Logout successful. Tokens have been revoked.']);
        }
    
        return view('logout')->with('message', 'Logout successful. Tokens have been revoked.');
    }
    

    // Android Login
    public function loginAndroid(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Cek jika user aktif
            if (!$user->is_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Mohon Maaf akun anda belum aktif, Silahkan Hubungin Administrator!',
                    'data' => null
                ]);
            }

            $user->last_login_at = $user->current_login_at ?? now(); // Simpan waktu login sebelumnya
            $user->current_login_at = now(); // Simpan waktu login saat ini
            $user->save();

            // $user->tokens()->delete();
            $token = $user->createToken('device_id')->plainTextToken;

            $response = [
                'success' => true,
                'message' => 'Login Berhasil!',
                'data' => [
                    'token_type' => 'Bearer',
                    'token' => $token,
                    'name' => $user->name,
                    'last_login_at' => $user->last_login_at,
                    'current_login_at' => $user->current_login_at,
                ]
            ];
        } else {
            $response = [
                'success' => false,
                'message' => 'Cek kembali email & password anda!',
                'data' => null
            ];
        }

        return response()->json($response);
    }
}

