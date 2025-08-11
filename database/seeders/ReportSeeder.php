<?php

namespace Database\Seeders;

use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ReportSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();
        
        $reports = [
            // Daily Reports
            [
                'title' => 'Laporan Harian Produksi 18 Juni 2025',
                'content' => "Produksi hari ini berjalan lancar. Target harian tercapai 100%.\n\nDetail Produksi:\n- Bumper Depan Avanza: 100 unit\n- Bumper Belakang Avanza: 95 unit\n- Spion Yaris: 150 unit\n\nCatatan: Tidak ada kendala signifikan.",
                'production_schedule_id' => null,
                'created_by' => 2, // Budi (Manager)
                'report_type' => 'daily',
                'created_at' => $now->copy()->subDays(4),
            ],
            [
                'title' => 'Laporan Harian Produksi 19 Juni 2025',
                'content' => "Produksi hari ini mencapai 95% dari target harian.\n\nDetail Produksi:\n- Bumper Depan Avanza: 95 unit\n- Bumper Belakang Avanza: 90 unit\n- Spion Yaris: 140 unit\n\nCatatan: Terjadi penundaan 30 menit karena masalah pada mesin injection molding. Masalah sudah diatasi oleh tim maintenance.",
                'production_schedule_id' => null,
                'created_by' => 2, // Budi (Manager)
                'report_type' => 'daily',
                'created_at' => $now->copy()->subDays(3),
            ],
            
            // Incident Reports
            [
                'title' => 'Laporan Insiden: Kerusakan Mesin Injection Molding',
                'content' => "Pada tanggal 19 Juni 2025 pukul 10:30, mesin injection molding di Line A mengalami kerusakan. Mesin berhenti beroperasi selama 30 menit.\n\nPenyebab: Kelebihan beban pada sistem hidrolik\n\nTindakan yang diambil: Tim maintenance melakukan perbaikan darurat dan menormalkan tekanan hidrolik.\n\nRekomendasi: Perlu dilakukan pemeriksaan rutin pada sistem hidrolik setiap minggu untuk mencegah kejadian serupa.",
                'production_schedule_id' => 1,
                'created_by' => 6, // Rudi (Maintenance)
                'report_type' => 'incident',
                'created_at' => $now->copy()->subDays(3),
            ],
            
            // Quality Reports
            [
                'title' => 'Laporan Kualitas: Bumper Depan Avanza',
                'content' => "Hasil inspeksi kualitas bumper depan Avanza batch #A2506:\n\n- Total produksi: 500 unit\n- Lolos QC: 485 unit (97%)\n- Defect: 15 unit (3%)\n\nJenis defect:\n1. Permukaan tidak rata: 8 unit\n2. Warna tidak sesuai: 4 unit\n3. Dimensi tidak sesuai: 3 unit\n\nTindakan: 15 unit defect telah dipisahkan untuk diproses ulang. Penyesuaian pada parameter mesin telah dilakukan untuk batch berikutnya.",
                'production_schedule_id' => 1,
                'created_by' => 7, // Nina (QC)
                'report_type' => 'quality',
                'created_at' => $now->copy()->subDays(3),
            ],
            
            // Maintenance Reports
            [
                'title' => 'Laporan Pemeliharaan Rutin: Line A',
                'content' => "Pemeliharaan rutin Line A dilakukan pada tanggal 20 Juni 2025.\n\nKegiatan yang dilakukan:\n1. Penggantian oli hidrolik\n2. Kalibrasi sensor\n3. Pembersihan nozzle injection\n4. Pemeriksaan sistem kelistrikan\n\nHasil: Semua sistem berfungsi normal. Penggantian beberapa komponen wear and tear dilakukan sesuai jadwal preventive maintenance.\n\nRekomendasi: Jadwalkan penggantian belt conveyor dalam 2 bulan ke depan.",
                'production_schedule_id' => null,
                'created_by' => 6, // Rudi (Maintenance)
                'report_type' => 'maintenance',
                'created_at' => $now->copy()->subDays(2),
            ],
            
            // More Daily Reports
            [
                'title' => 'Laporan Harian Produksi 20 Juni 2025',
                'content' => "Produksi hari ini mencapai 105% dari target harian.\n\nDetail Produksi:\n- Bumper Belakang Avanza: 110 unit\n- Spion Yaris: 160 unit\n\nCatatan: Produktivitas meningkat setelah perbaikan dan pemeliharaan mesin.",
                'production_schedule_id' => null,
                'created_by' => 3, // Dewi (Manager)
                'report_type' => 'daily',
                'created_at' => $now->copy()->subDays(2),
            ],
            [
                'title' => 'Laporan Harian Produksi 21 Juni 2025',
                'content' => "Produksi hari ini mencapai 100% dari target harian.\n\nDetail Produksi:\n- Bumper Belakang Avanza: 100 unit\n- Spion Yaris: 150 unit\n\nCatatan: Produksi berjalan normal tanpa kendala.",
                'production_schedule_id' => null,
                'created_by' => 3, // Dewi (Manager)
                'report_type' => 'daily',
                'created_at' => $now->copy()->subDays(1),
            ],
        ];

        foreach ($reports as $report) {
            Report::create($report);
        }
    }
}
