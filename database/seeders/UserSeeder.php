<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'test admin',
            'email' => 'testadmin@gmail.com',
            'username' => 'testadmin',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);
    }
}
