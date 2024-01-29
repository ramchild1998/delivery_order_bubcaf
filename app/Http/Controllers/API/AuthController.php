<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Laravel\Sanctum\HasApiTokens;

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
                'message' => 'Terjadi kesalahan validasi!',
                'data' => $validator->errors()
            ], 400);
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

    //    Updated on 09.19 AM 9 Jan 2024
    // Fungsi Login
    public function login(Request $request): JsonResponse
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();
        
        if (!$user || !Auth::attempt($credentials)) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email atau password anda salah!',
                    'data' => null
                ], 401);
            } else {
                return redirect()->route('login');
            }
        }

        // Check if user is active and has admin role
        if (!$user->is_active || !in_array($user->role_id, [1, 2])) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Akun tidak valid atau tidak memiliki akses, pastikan anda adalah admin!',
                    'data' => [
                        'role_id' => $user->role_id,
                    ]
                ], 401);
            } else {
                return redirect()->route('login');
            }
        }

        $token = $user->createToken('user_token')->plainTextToken;
        // Check if user is already logged in
        if ($user->is_logged_in) {
            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah login di tempat lain. Harap logout terlebih dahulu!',
                    'data' => [
                        'token' => $token, //Data Sementara selama DEV, Perlu dihapus jika di release!
                        'name' => $user->name,
                        'role_id' => $user->role_id,
                        'is_logged_in' => $user->is_logged_in,
                    ]
                ], 401);
            } else {
                return redirect()->route('login');
            }
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

        if ($request->wantsJson()) {
            $response = [
                'success' => true,
                'message' => 'Login successful!',
                'data' => [
                    'token' => $token,
                    'name' => $user->name,
                    'role_id' => $user->role_id,
                    'type' => $user->type,
                    'is_logged_in' => $user->is_logged_in,
                    'last_login_at' => $user->last_login_at,
                    'current_login_at' => $user->current_login_at,
                ]
            ];
    
            return response()->json($response, 200);
        } else {
            return redirect()->intended('home');
        }
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
        $user->update([
            'last_login_at' => null,
            'is_logged_in' => false, // Set is_logged_in to false
        ]);


        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'Logout successful. Tokens have been revoked.',
                'is_logged_in' => $user->is_logged_in,
            ], 200);
        }

        return view('auth/login')->with('message', 'Logout successful. Tokens have been revoked.');
    }

}