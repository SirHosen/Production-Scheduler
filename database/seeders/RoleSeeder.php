<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin',
            'permissions' => json_encode(['all']),
        ]);

        Role::create([
            'name' => 'Production Manager',
            'slug' => 'manager',
            'permissions' => json_encode([
                'create-schedule',
                'edit-schedule',
                'view-schedule',
                'create-task',
                'assign-task',
                'view-reports',
                'create-reports',
            ]),
        ]);

        Role::create([
            'name' => 'Factory Worker',
            'slug' => 'worker',
            'permissions' => json_encode([
                'view-schedule',
                'view-task',
                'update-task',
                'create-reports',
            ]),
        ]);
    }
}
