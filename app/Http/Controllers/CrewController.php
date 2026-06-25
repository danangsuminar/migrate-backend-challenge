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

        // 3. Query menggunakan relasi JOIN antar tabel
        $crewList = CrewMember::select('crewmember.*') // Ambil data biodatanya saja agar bersih
            ->join('crewservicehistory', 'crewmember.CrewMemberId', '=', 'crewservicehistory.CrewMemberId')
            ->where('crewservicehistory.ShipCode', $validated['ship_code'])
            ->paginate($perPage, ['*'], 'page_number', $page);

        // 4. Transformasi format Laravel menjadi format PagedResult bawaan .NET lama
        return response()->json([
            'Items' => $crewList->items(),          // Mengambil array datanya saja
            'TotalCount' => $crewList->total(),     // Total keseluruhan data
            'PageNumber' => $crewList->currentPage(), // Halaman saat ini
            'PageSize' => $crewList->perPage(),     // Ukuran per halaman
            'TotalPages' => $crewList->lastPage(),  // Total halaman
            'HasNextPage' => $crewList->hasMorePages(), // True/False apakah ada halaman selanjutnya
            'HasPreviousPage' => ! $crewList->onFirstPage()
        ]);
    }
}