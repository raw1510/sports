<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         User::updateOrCreate(
            ['email' => 'admin123'], // unique check
            [
                'name' => 'Super Admin',
                'password' => Hash::make('pass123'), // change to secure password
            ]
        );
    }
}
