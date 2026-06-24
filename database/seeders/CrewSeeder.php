<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CrewMember;
use App\Models\CrewServiceHistory;
use App\Models\Ship;
use App\Models\CrewRank;
use Faker\Factory as Faker;
use Carbon\Carbon;

class CrewSeeder extends Seeder
{
    public function run()
    {
        // Panggil pabrik data palsu
        $faker = Faker::create();
        
        // Ambil semua ID Kapal dan ID Jabatan yang sudah ada di database
        $ships = Ship::pluck('Code')->toArray();
        $ranks = CrewRank::pluck('RankId')->toArray();

        // Kita buat 50 data kru
        for ($i = 1; $i <= 50; $i++) {
            // 1. Generate ID Kru (Contoh: CREW001)
            $crewId = 'CREW' . str_pad($i, 3, '0', STR_PAD_LEFT);

            // Jika kru sudah ada (misal script dijalankan ulang), lewati saja
            if (CrewMember::where('CrewMemberId', $crewId)->exists()) {
                continue;
            }

            // 2. Buat Kru Baru
            $crew = CrewMember::create([
                'CrewMemberId' => $crewId,
                'FirstName'    => $faker->firstName(),
                'LastName'     => $faker->lastName(),
                'BirthDate'    => $faker->dateTimeBetween('-60 years', '-25 years')->format('Y-m-d'),
                'Nationality'  => $faker->randomElement(['Indonesian', 'American', 'British', 'Filipino', 'Indian', 'Japanese'])
            ]);

            // 3. Buat Histori Penugasan yang Masuk Akal
            $signOn = Carbon::instance($faker->dateTimeBetween('-1 year', 'now'));
            $endOfContract = (clone $signOn)->addMonths(rand(6, 9));
            
            // 70% kemungkinan kru sudah turun (SignOff), 30% masih di kapal (null)
            $isSignedOff = $faker->boolean(70);
            $signOff = $isSignedOff ? (clone $signOn)->addDays(rand(30, 200)) : null;

            // Mencegah error: Tanggal SignOff tidak boleh melebihi EndOfContract
            if ($signOff && $signOff > $endOfContract) {
                $signOff = $endOfContract;
            }

            CrewServiceHistory::create([
                'CrewMemberId'      => $crew->CrewMemberId,
                'ShipCode'          => $faker->randomElement($ships),
                'RankId'            => $faker->randomElement($ranks),
                'SignOnDate'        => $signOn->format('Y-m-d'),
                'SignOffDate'       => $signOff ? $signOff->format('Y-m-d') : null,
                'EndOfContractDate' => $endOfContract->format('Y-m-d'),
            ]);
        }
    }
}