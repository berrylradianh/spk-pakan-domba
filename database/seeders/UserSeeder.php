<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin SPK',
                'role_id' => 1,
                'username' => 'adminspk',
                'email' => 'admin@spk.com',
                'password' => Hash::make('12345678'),
            ],
            [
                'name' => 'User SPK',
                'role_id' => 2,
                'username' => 'user1spk',
                'email' => 'user@spk.com',
                'password' => Hash::make('12345678'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
