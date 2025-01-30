<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User spesifik
        User::create([
            'name' => 'Irga',
            'email' => 'irga24@gmail.com',
            'password' => bcrypt('1234567'),
            'position' => 'Admin', // Gunakan kolom position
        ]);
    }
}
