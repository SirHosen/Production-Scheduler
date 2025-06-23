<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin sudah dibuat di AdminSeeder
        
        // Production Managers
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi.manager@mmid.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Manager
            'department' => 'Produksi',
            'employee_id' => 'MGR001',
        ]);
        
        User::create([
            'name' => 'Dewi Lestari',
            'email' => 'dewi.manager@mmid.com',
            'password' => Hash::make('password'),
            'role_id' => 2, // Manager
            'department' => 'Quality Control',
            'employee_id' => 'MGR002',
        ]);

        // Factory Workers
        $workers = [
            [
                'name' => 'Agus Pratama',
                'email' => 'agus.worker@mmid.com',
                'department' => 'Produksi',
                'employee_id' => 'WRK001',
            ],
            [
                'name' => 'Siti Rahayu',
                'email' => 'siti.worker@mmid.com',
                'department' => 'Produksi',
                'employee_id' => 'WRK002',
            ],
            [
                'name' => 'Rudi Hartono',
                'email' => 'rudi.worker@mmid.com',
                'department' => 'Maintenance',
                'employee_id' => 'WRK003',
            ],
            [
                'name' => 'Nina Wijaya',
                'email' => 'nina.worker@mmid.com',
                'department' => 'Quality Control',
                'employee_id' => 'WRK004',
            ],
            [
                'name' => 'Eko Saputra',
                'email' => 'eko.worker@mmid.com',
                'department' => 'Logistik',
                'employee_id' => 'WRK005',
            ],
            [
                'name' => 'Rina Fitriani',
                'email' => 'rina.worker@mmid.com',
                'department' => 'Produksi',
                'employee_id' => 'WRK006',
            ],
            [
                'name' => 'Doni Kusuma',
                'email' => 'doni.worker@mmid.com',
                'department' => 'Teknik',
                'employee_id' => 'WRK007',
            ],
            [
                'name' => 'Maya Indah',
                'email' => 'maya.worker@mmid.com',
                'department' => 'Produksi',
                'employee_id' => 'WRK008',
            ],
        ];

        foreach ($workers as $worker) {
            User::create([
                'name' => $worker['name'],
                'email' => $worker['email'],
                'password' => Hash::make('password'),
                'role_id' => 3, // Worker
                'department' => $worker['department'],
                'employee_id' => $worker['employee_id'],
            ]);
        }
    }
}
