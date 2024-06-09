<?php

namespace Database\Seeders;

use App\Models\Penilaian;
use Illuminate\Database\Seeder;

class PenilaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $penilaians = [
            [
                'kode_alternatif' => 'A3',
                'jenis_pakan' => 'Singkong',
                'bobot' => '2, 3, 2, 2, 3, 2, 1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A7',
                'jenis_pakan' => 'Tongkol Jagung',
                'bobot' => '3, 4, 2, 2, 2, 2, 2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A11',
                'jenis_pakan' => 'Campuran A',
                'bobot' => '5, 5, 3, 2, 4, 3, 3',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($penilaians as $penilaian) {
            Penilaian::create($penilaian);
        }
    }
}
