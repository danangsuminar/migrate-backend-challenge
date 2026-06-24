<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BudgetData;
use App\Models\AccountTransaction;
use App\Models\Ship;
use App\Models\ChartOfAccounts;
use Faker\Factory as Faker;
use Carbon\Carbon;

class FinancialSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        
        // Ambil semua Kapal yang aktif
        $ships = Ship::where('Status', 1)->pluck('Code')->toArray();
        // Ambil semua akun khusus Child (karena transaksi tidak dilakukan di akun Parent)
        $childAccounts = ChartOfAccounts::where('AccountType', 'Child')->pluck('AccountNumber')->toArray();

        // Kita akan generate data untuk tahun berjalan (misal 6 bulan terakhir)
        $monthsToGenerate = 6;

        foreach ($ships as $shipCode) {
            // Ambil 5 akun acak per kapal agar prosesnya tidak terlalu berat
            $randomAccounts = $faker->randomElements($childAccounts, 5);

            foreach ($randomAccounts as $accountNumber) {
                for ($i = 0; $i < $monthsToGenerate; $i++) {
                    // Set tanggal ke hari pertama di bulan tersebut
                    $period = Carbon::now()->startOfMonth()->subMonths($i)->format('Y-m-d');

                    // 1. Buat Budget (Tidak boleh minus)
                    BudgetData::firstOrCreate(
                        ['ShipCode' => $shipCode, 'AccountNumber' => $accountNumber, 'AccountPeriod' => $period],
                        ['BudgetValue' => $faker->randomFloat(2, 1000, 50000)] // Nominal antara 1.000 - 50.000
                    );

                    // 2. Buat Transaksi Aktual (Tidak boleh minus)
                    AccountTransaction::create([
                        'ShipCode'      => $shipCode,
                        'AccountNumber' => $accountNumber,
                        'AccountPeriod' => $period,
                        'ActualValue'   => $faker->randomFloat(2, 500, 48000)
                    ]);
                }
            }
        }
    }
}