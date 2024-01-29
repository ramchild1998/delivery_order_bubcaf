<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    use AuthenticatesUsers;

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$this->attemptLogin($request)) {
            return redirect()->route('login')->withErrors(['message' => 'Email atau password anda salah!']);
        }

        $user = User::where('email', $credentials['email'])->first();

        // Check if user is active and has admin role
        if (!$user->is_active || !in_array($user->role_id, [1, 2])) {
            return redirect()->route('login')->withErrors(['message' => 'Akun tidak valid atau tidak memiliki akses, pastikan anda adalah admin!']);
        }

        // Check if user is already logged in
        if ($user->is_logged_in) {
            $lastLoginTime = Carbon::parse($user->current_login_at);

            // Check if the user's last login time is within 15 minutes from now
            if ($lastLoginTime->addMinutes(15)->isFuture()) {
                // User is still within the 15-minute window, update login time and continue
                $user->current_login_at = now();
                $user->save();
            } else {
                // User has exceeded the 15-minute window, set is_logged_in to false
                $user->is_logged_in = false;
                // Revoke the user's access tokens
                $user->tokens()->delete();
                $user->save();

            }

            if ($request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Anda sudah login di tempat lain. Harap logout terlebih dahulu!',
                    'data' => [
                        'token' => $user->createToken('user_token')->plainTextToken,
                        'name' => $user->name,
                        'role_id' => $user->role_id,
                    ]
                ], 401);
            } else {
                return redirect()->route('home');
            }
        }

        $token = $user->createToken('user_token')->plainTextToken;

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

        return redirect()->intended('home');
    }


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