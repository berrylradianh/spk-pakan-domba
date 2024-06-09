<?php

namespace Database\Seeders;

use App\Models\Kriteria;
use Illuminate\Database\Seeder;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kriterias = [
            [
                'kode_kriteria' => 'C1',
                'nama_kriteria' => 'Serat',
                'keterangan' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C2',
                'nama_kriteria' => 'Lemak',
                'keterangan' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C3',
                'nama_kriteria' => 'Abu',
                'keterangan' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C4',
                'nama_kriteria' => 'Protein',
                'keterangan' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C5',
                'nama_kriteria' => 'Harga',
                'keterangan' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C6',
                'nama_kriteria' => 'Jarak Beli Pakan',
                'keterangan' => 'Cost',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'kode_kriteria' => 'C7',
                'nama_kriteria' => 'Ketersedian',
                'keterangan' => 'Benefit',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($kriterias as $kriteria) {
            Kriteria::create($kriteria);
        }
    }
}
