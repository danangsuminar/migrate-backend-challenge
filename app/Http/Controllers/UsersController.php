<?php

namespace App\Http\Controllers;

use App\Models\AppUser;
use App\Models\Ship;
use Illuminate\Http\JsonResponse;

class UsersController extends Controller
{
    // [HttpPost("{id}/Ships/{shipCode}")]
    public function assignShip(int $userId, string $shipCode): JsonResponse
    {
        // 1. Cari User
        $user = AppUser::find($userId);
        if (!$user) {
            return response()->json(['message' => "User with ID {$userId} not found"], 404);
        }

        // 2. Cari Ship
        $ship = Ship::find($shipCode);
        if (!$ship) {
            return response()->json(['message' => "Ship with code {$shipCode} not found"], 404);
        }

        // 3. Eksekusi Relasi (syncWithoutDetaching mencegah duplikasi data di tabel pivot)
        $user->ships()->syncWithoutDetaching([$shipCode]);

        return response()->json([
            'message' => "Ship {$shipCode} successfully assigned to User {$userId}"
        ], 200);
    }

    // [HttpDelete("{id}/Ships/{shipCode}")]
    public function removeShip(int $userId, string $shipCode): JsonResponse
    {
        $user = AppUser::find($userId);
        if (!$user) {
            return response()->json(['message' => "User with ID {$userId} not found"], 404);
        }

        // 4. Hapus relasi dari tabel pivot
        $user->ships()->detach($shipCode);

        return response()->json([
            'message' => "Ship {$shipCode} successfully removed from User {$userId}"
        ], 200);
    }
}