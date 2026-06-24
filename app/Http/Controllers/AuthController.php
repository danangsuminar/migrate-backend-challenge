<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\AppUser; // Pastikan modelmu di-import
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash; // Import Hash
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    public function login(LoginRequest $request): JsonResponse
    {
        // 1. Cari user di database berdasarkan username
        $user = AppUser::where('username', $request->username)->first();

        // 2. Cek apakah user ada DAN password cocok dengan hash di database
        if (!$user || !Hash::check($request->password, $user->password)) {
            Log::warning("Failed login attempt for username {$request->username}");
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        // 3. Buat Token menggunakan Sanctum
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Kembalikan response
        return response()->json([
            'Token' => $token,
            'Username' => $user->username,
            'Role' => $user->Role, // Pastikan casing ('Role' atau 'role') sesuai dengan database legacy-mu
            'ExpiresAtUtc' => now()->addMinutes(60)->toISOString()
        ]);
    }
}