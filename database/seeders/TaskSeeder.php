<?php

namespace Database\Seeders;

use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        $tasks = [
            // Tasks for Bumper Depan Avanza (Schedule 1)
            [
                'title' => 'Persiapan Material Bumper Depan',
                'description' => 'Menyiapkan semua material untuk produksi bumper depan Avanza',
                'production_schedule_id' => 1,
                'assigned_to' => 5, // Eko (Logistik)
                'status' => 'completed',
                'due_date' => $now->copy()->subDays(5),
                'priority' => 3,
            ],
            [
                'title' => 'Pengoperasian Mesin Injection Molding',
                'description' => 'Mengoperasikan mesin injection molding untuk bumper depan',
                'production_schedule_id' => 1,
                'assigned_to' => 4, // Agus (Produksi)
                'status' => 'completed',
                'due_date' => $now->copy()->subDays(4),
                'priority' => 4,
            ],
            [
                'title' => 'QC Bumper Depan',
                'description' => 'Melakukan pemeriksaan kualitas pada bumper depan yang sudah diproduksi',
                'production_schedule_id' => 1,
                'assigned_to' => 7, // Nina (QC)
                'status' => 'completed',
                'due_date' => $now->copy()->subDays(3),
                'priority' => 5,
            ],
            
            // Tasks for Bumper Belakang Avanza (Schedule 2)
            [
                'title' => 'Persiapan Material Bumper Belakang',
                'description' => 'Menyiapkan semua material untuk produksi bumper belakang Avanza',
                'production_schedule_id' => 2,
                'assigned_to' => 5, // Eko (Logistik)
                'status' => 'completed',
                'due_date' => $now->copy()->subDays(2),
                'priority' => 3,
            ],
            [
                'title' => 'Pengoperasian Mesin Injection Molding',
                'description' => 'Mengoperasikan mesin injection molding untuk bumper belakang',
                'production_schedule_id' => 2,
                'assigned_to' => 5, // Siti (Produksi)
                'status' => 'in-progress',
                'due_date' => $now->copy()->addDays(1),
                'priority' => 4,
            ],
            [
                'title' => 'QC Bumper Belakang',
                'description' => 'Melakukan pemeriksaan kualitas pada bumper belakang yang sudah diproduksi',
                'production_schedule_id' => 2,
                'assigned_to' => 7, // Nina (QC)
                'status' => 'pending',
                'due_date' => $now->copy()->addDays(1),
                'priority' => 5,
            ],
            
            // Tasks for Dashboard Xenia (Schedule 3)
            [
                'title' => 'Persiapan Material Dashboard',
                'description' => 'Menyiapkan semua material untuk produksi dashboard Xenia',
                'production_schedule_id' => 3,
                'assigned_to' => 5, // Eko (Logistik)
                'status' => 'pending',
                'due_date' => $now->copy()->addDays(2),
                'priority' => 3,
            ],
            [
                'title' => 'Setup Mesin Produksi Dashboard',
                'description' => 'Melakukan setup mesin untuk produksi dashboard',
                'production_schedule_id' => 3,
                'assigned_to' => 6, // Rudi (Maintenance)
                'status' => 'pending',
                'due_date' => $now->copy()->addDays(2),
                'priority' => 4,
            ],
            
            // Tasks for Spion Yaris (Schedule 4)
            [
                'title' => 'Produksi Casing Spion',
                'description' => 'Memproduksi casing spion untuk Toyota Yaris',
                'production_schedule_id' => 4,
                'assigned_to' => 9, // Rina (Produksi)
                'status' => 'in-progress',
                'due_date' => $now->copy()->addDays(1),
                'priority' => 3,
            ],
            [
                'title' => 'Pemasangan Kaca Spion',
                'description' => 'Memasang kaca pada casing spion',
                'production_schedule_id' => 4,
                'assigned_to' => 11, // Maya (Produksi)
                'status' => 'pending',
                'due_date' => $now->copy()->addDays(2),
                'priority' => 3,
            ],
            
            // Tasks for Kaca Depan Rush (Schedule 5)
            [
                'title' => 'Persiapan Material Kaca',
                'description' => 'Menyiapkan material kaca untuk produksi kaca depan Rush',
                'production_schedule_id' => 5,
                'assigned_to' => 5, // Eko (Logistik)
                'status' => 'pending',
                'due_date' => $now->copy()->addDays(3),
                'priority' => 4,
            ],
            
            // Tasks for Pintu Depan Terios (Schedule 6)
            [
                'title' => 'Inspeksi Akhir Pintu Depan',
                'description' => 'Melakukan inspeksi akhir pada pintu depan Terios yang sudah selesai',
                'production_schedule_id' => 6,
                'assigned_to' => 7, // Nina (QC)
                'status' => 'completed',
                'due_date' => $now->copy()->subDays(6),
                'priority' => 4,
            ],
        ];

        foreach ($tasks as $task) {
            Task::create($task);
        }
    }
}
