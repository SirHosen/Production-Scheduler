<?php

namespace Database\Seeders;

use App\Models\ProductionSchedule;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ProductionScheduleSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        $schedules = [
            [
                'title' => 'Produksi Bumper Depan Avanza',
                'description' => 'Produksi bumper depan untuk Toyota Avanza',
                'start_time' => $now->copy()->subDays(5),
                'end_time' => $now->copy()->subDays(3),
                'status' => 'completed',
                'production_line' => 'Line A',
                'target_quantity' => 500,
                'completed_quantity' => 500,
                'created_by' => 2, // Budi (Manager)
                'notes' => 'Produksi selesai tepat waktu',
            ],
            [
                'title' => 'Produksi Bumper Belakang Avanza',
                'description' => 'Produksi bumper belakang untuk Toyota Avanza',
                'start_time' => $now->copy()->subDays(2),
                'end_time' => $now->copy()->addDays(1),
                'status' => 'active',
                'production_line' => 'Line B',
                'target_quantity' => 500,
                'completed_quantity' => 350,
                'created_by' => 2, // Budi (Manager)
                'notes' => 'Produksi berjalan lancar',
            ],
            [
                'title' => 'Produksi Dashboard Xenia',
                'description' => 'Produksi dashboard untuk Daihatsu Xenia',
                'start_time' => $now->copy()->addDays(2),
                'end_time' => $now->copy()->addDays(5),
                'status' => 'pending',
                'production_line' => 'Line C',
                'target_quantity' => 300,
                'completed_quantity' => 0,
                'created_by' => 2, // Budi (Manager)
                'notes' => 'Menunggu material dari supplier',
            ],
            [
                'title' => 'Produksi Spion Yaris',
                'description' => 'Produksi spion untuk Toyota Yaris',
                'start_time' => $now->copy()->subDays(1),
                'end_time' => $now->copy()->addDays(2),
                'status' => 'active',
                'production_line' => 'Line D',
                'target_quantity' => 1000,
                'completed_quantity' => 400,
                'created_by' => 3, // Dewi (Manager)
                'notes' => 'Prioritas tinggi untuk memenuhi target ekspor',
            ],
            [
                'title' => 'Produksi Kaca Depan Rush',
                'description' => 'Produksi kaca depan untuk Toyota Rush',
                'start_time' => $now->copy()->addDays(3),
                'end_time' => $now->copy()->addDays(7),
                'status' => 'pending',
                'production_line' => 'Line E',
                'target_quantity' => 200,
                'completed_quantity' => 0,
                'created_by' => 3, // Dewi (Manager)
                'notes' => 'Perlu persiapan khusus untuk material kaca',
            ],
            [
                'title' => 'Produksi Pintu Depan Terios',
                'description' => 'Produksi pintu depan untuk Daihatsu Terios',
                'start_time' => $now->copy()->subDays(10),
                'end_time' => $now->copy()->subDays(6),
                'status' => 'completed',
                'production_line' => 'Line A',
                'target_quantity' => 400,
                'completed_quantity' => 400,
                'created_by' => 2, // Budi (Manager)
                'notes' => 'Produksi selesai dengan kualitas baik',
            ],
        ];

        foreach ($schedules as $schedule) {
            ProductionSchedule::create($schedule);
        }
    }
}
