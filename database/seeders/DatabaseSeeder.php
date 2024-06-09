<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $seeders = [
            RoleSeeder::class,
            UserSeeder::class,
            KriteriaSeeder::class,
            BobotSeeder::class,
            PakanSeeder::class,
            PenilaianSeeder::class,
        ];

        foreach ($seeders as $seeder) {
            $this->call($seeder);
        }
    }
}
