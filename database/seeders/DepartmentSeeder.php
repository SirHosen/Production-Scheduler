<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    public function run()
    {
        $departments = [
            [
                'name' => 'Produksi',
                'code' => 'PROD',
                'description' => 'Departemen yang bertanggung jawab atas proses produksi'
            ],
            [
                'name' => 'Quality Control',
                'code' => 'QC',
                'description' => 'Departemen yang bertanggung jawab atas kualitas produk'
            ],
            [
                'name' => 'Maintenance',
                'code' => 'MAINT',
                'description' => 'Departemen yang bertanggung jawab atas pemeliharaan mesin dan peralatan'
            ],
            [
                'name' => 'Logistik',
                'code' => 'LOG',
                'description' => 'Departemen yang bertanggung jawab atas pengadaan dan distribusi material'
            ],
            [
                'name' => 'Teknik',
                'code' => 'ENG',
                'description' => 'Departemen yang bertanggung jawab atas desain dan pengembangan produk'
            ],
        ];

        foreach ($departments as $department) {
            Department::create($department);
        }
    }
}
