<?php

namespace Database\Seeders;

use App\Models\Pakan;
use Illuminate\Database\Seeder;

class PakanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pakans = [
            [
                'kode_alternatif' => 'A1',
                'jenis_pakan' => 'Daun Jagung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A2',
                'jenis_pakan' => 'Bekatul',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A3',
                'jenis_pakan' => 'Singkong',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A4',
                'jenis_pakan' => 'Daun Singkong',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A5',
                'jenis_pakan' => 'Batang Singkong',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A6',
                'jenis_pakan' => 'Jerami Kedelai',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A7',
                'jenis_pakan' => 'Tongkol Jagung',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A8',
                'jenis_pakan' => 'Odot',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A9',
                'jenis_pakan' => 'Tetes Tebu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A10',
                'jenis_pakan' => 'Ampas Tahu',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A11',
                'jenis_pakan' => 'Campuran A',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_alternatif' => 'A12',
                'jenis_pakan' => 'Campuran B',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($pakans as $pakan) {
            Pakan::create($pakan);
        }
    }
}
