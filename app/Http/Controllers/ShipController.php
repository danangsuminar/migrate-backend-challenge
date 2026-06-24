<?php

namespace App\Http\Controllers;

use App\Models\Ship;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShipController extends Controller
{
    // [HttpGet]
    public function index(): JsonResponse
    {
        $ships = Ship::all();
        return response()->json($ships);
    }

    // [HttpGet("{code}")]
    public function show(string $code): JsonResponse
    {
        $ship = Ship::find($code);
        
        if (!$ship) {
            return response()->json(['message' => "Ship with code {$code} not found"], 404);
        }
        
        return response()->json($ship);
    }

    // [HttpPost]
    public function store(Request $request): JsonResponse
    {
        // Validasi langsung di Controller (bisa juga dipindah ke FormRequest seperti LoginRequest)
        $validated = $request->validate([
            'Code' => 'required|string|unique:Ship,Code',
            'Name' => 'required|string',
            'FiscalYear' => 'required|string'
        ]);

        $ship = Ship::create($validated);
        
        // Return 201 Created
        return response()->json($ship, 201);
    }

    // [HttpPut("{code}")]
    public function update(Request $request, string $code): JsonResponse
    {
        $ship = Ship::find($code);
        
        if (!$ship) {
            return response()->json(['message' => "Ship with code {$code} not found"], 404);
        }

        $validated = $request->validate([
            'Name' => 'required|string',
            'FiscalYear' => 'required|string'
        ]);

        $ship->update($validated);
        
        // Return 204 No Content (Sesuai dengan standard C# di repositori)
        return response()->json(null,204);
    }

    // [HttpDelete("{code}")]
    public function destroy(string $code): JsonResponse
    {
        $ship = Ship::find($code);
        
        if (!$ship) {
            return response()->json(['message' => "Ship with code {$code} not found"], 404);
        }

        $ship->delete();
        
        return response()->json(null,204);
    }
}