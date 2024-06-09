<?php

namespace Database\Seeders;

use App\Models\Bobot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BobotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bobots = [
            [
                'kode_kriteria' => 'C1',
                'nama_sub_kriteria' => '<13%',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C1',
                'nama_sub_kriteria' => '13-16%',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C1',
                'nama_sub_kriteria' => '17-19%',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C1',
                'nama_sub_kriteria' => '20-25%',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C1',
                'nama_sub_kriteria' => '>25%',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_sub_kriteria' => '<13%',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_sub_kriteria' => '17-19%',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_sub_kriteria' => '20-25%',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_sub_kriteria' => '>25%',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_sub_kriteria' => '<13%',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_sub_kriteria' => '13-16%',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_sub_kriteria' => '17-19%',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_sub_kriteria' => '20-25%',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_sub_kriteria' => '>25%',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_sub_kriteria' => '<13%',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_sub_kriteria' => '13-16%',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_sub_kriteria' => '17-19%',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_sub_kriteria' => '20-25%',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_sub_kriteria' => '>25%',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_sub_kriteria' => 'Sangat Mahal',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_sub_kriteria' => 'Mahal',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_sub_kriteria' => 'Cukup',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_sub_kriteria' => 'Murah',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_sub_kriteria' => 'Sangat Murah',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_sub_kriteria' => 'Sangat Jauh',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_sub_kriteria' => 'Jauh',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_sub_kriteria' => 'Cukup',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_sub_kriteria' => 'Dekat',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_sub_kriteria' => 'Sangat Dekat',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_sub_kriteria' => 'Sangat Sedikit',
                'bobot' => '1',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_sub_kriteria' => 'Sedikit',
                'bobot' => '2',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_sub_kriteria' => 'Cukup',
                'bobot' => '3',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_sub_kriteria' => 'Banyak',
                'bobot' => '4',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_sub_kriteria' => 'Sangat Banyak',
                'bobot' => '5',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($bobots as $bobot) {
            Bobot::create($bobot);
        }
    }
}
