<?php

namespace App\Http\Controllers;

use App\Models\CrewMember; // Pastikan model ini sesuai dengan nama model legacy-mu
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CrewController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        // 1. Validasi Query Parameter
        $validated = $request->validate([
            'ship_code' => 'required|string',
            'page_number' => 'nullable|integer|min:1',
            'page_size' => 'nullable|integer|min:1',
        ]);

        // 2. Tentukan nilai default jika client tidak mengirim ukuran halaman
        $perPage = $request->input('page_size', 10); // Default 10 data per halaman
        $page = $request->input('page_number', 1);   // Default halaman 1

        // 3. Query ke Database dengan relasi/kondisi (Sesuai legacy table-mu)
        // Asumsi: tabel CrewMember memiliki kolom foreign key ke kapal, misalnya 'ShipCode'
        $crewList = CrewMember::where('ShipCode', $validated['ship_code'])
            ->paginate($perPage, ['*'], 'page_number', $page);

        // 4. Return hasil paginasi
        return response()->json($crewList);
    }
}