<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mmid.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
            'employee_id' => 'ADM001',
        ]);
    }
}
