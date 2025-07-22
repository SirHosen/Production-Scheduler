# Sistem Manajemen Produksi MMID

![Status](https://img.shields.io/badge/status-active-success.svg)
![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.2.28-777BB4?logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0.42-4479A1?logo=mysql&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-Framework-FF2D20?logo=laravel&logoColor=white)

## 📋 Deskripsi Proyek

Sistem Manajemen Produksi MMID adalah aplikasi web yang dirancang untuk mengelola proses produksi di lingkungan manufaktur. Sistem ini memungkinkan manajemen jadwal produksi, penugasan kerja, pemantauan kualitas, dan pelaporan yang terintegrasi untuk meningkatkan efisiensi operasional pabrik.

### 🎯 Tujuan Utama
- Mengotomatisasi proses penjadwalan produksi
- Meningkatkan koordinasi antar departemen
- Memfasilitasi pelaporan real-time
- Mengoptimalkan alur kerja produksi
- Menyediakan sistem kontrol kualitas yang terintegrasi

## 🏗️ Arsitektur Sistem

### Database Schema
Sistem menggunakan database MySQL dengan struktur tabel utama:

```
users ←→ roles
  ↓
departments
  ↓
production_schedules ←→ tasks
  ↓
reports
```

### Entitas Utama
- **Users**: Manajemen pengguna sistem
- **Roles**: Sistem peran (Administrator, Manajer Produksi, Pekerja Pabrik)
- **Departments**: Departemen (Produksi, Quality Control, Maintenance, Logistik, Teknik)
- **Production Schedules**: Jadwal produksi dengan target dan status
- **Tasks**: Tugas-tugas yang ditetapkan kepada pekerja
- **Reports**: Laporan harian, insiden, kualitas, dan pemeliharaan

## 🚀 Fitur Utama

### 👨‍💼 Administrator
- ✅ Manajemen pengguna dan peran
- ✅ Konfigurasi departemen
- ✅ Akses penuh ke semua fitur sistem
- ✅ Manajemen konfigurasi sistem

### 👨‍🏭 Manajer Produksi
- ✅ Pembuatan dan pengeditan jadwal produksi
- ✅ Penugasan tugas kepada pekerja
- ✅ Pemantauan kemajuan produksi
- ✅ Pembuatan laporan produksi dan kualitas
- ✅ Penetapan target kuantitas

### 👷‍♂️ Pekerja Pabrik
- ✅ Melihat jadwal produksi yang relevan
- ✅ Mengelola tugas yang ditetapkan
- ✅ Pembaruan status tugas real-time
- ✅ Pembuatan laporan harian dan insiden
- ✅ Pelaporan masalah kualitas

## 🛠️ Teknologi yang Digunakan

- **Backend**: PHP 8.2.28
- **Framework**: Laravel (berdasarkan struktur migrasi)
- **Database**: MySQL 8.0.42
- **Server**: Ubuntu 22.04.1
- **Tools**: phpMyAdmin 5.1.1

## 📊 Diagram Sistem

### Use Case Diagram
```
Administrator ──→ Kelola Pengguna
              ──→ Kelola Departemen
              ──→ Konfigurasi Sistem

Manajer Produksi ──→ Buat Jadwal Produksi
                 ──→ Tetapkan Tugas
                 ──→ Pantau Kemajuan
                 ──→ Buat Laporan

Pekerja Pabrik ──→ Lihat Jadwal
               ──→ Perbarui Status Tugas
               ──→ Buat Laporan Harian
```

### Entity Relationship Diagram
```sql
users (1) ──→ (N) production_schedules
users (1) ──→ (N) tasks
users (1) ──→ (N) reports
production_schedules (1) ──→ (N) tasks
production_schedules (1) ──→ (N) reports
roles (1) ──→ (N) users
departments (1) ──→ (N) users
```

## 🚦 Status Sistem

### Status Produksi
- **Pending**: Jadwal yang belum dimulai
- **Active**: Jadwal yang sedang berjalan
- **Completed**: Jadwal yang telah selesai

### Status Tugas
- **Pending**: Tugas yang belum dimulai
- **In-Progress**: Tugas yang sedang dikerjakan
- **Completed**: Tugas yang telah selesai

### Jenis Laporan
- **Daily**: Laporan harian produksi
- **Incident**: Laporan insiden atau masalah
- **Quality**: Laporan kontrol kualitas
- **Maintenance**: Laporan pemeliharaan

## 🔧 Instalasi

### Prasyarat
- PHP >= 8.2
- MySQL >= 8.0
- Composer
- Laravel Framework

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/username/mmid-production-system.git
cd mmid-production-system
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Konfigurasi Environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi Database**
```env
DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=mmid_production
DB_USERNAME=your_username
DB_PASSWORD=your_password
```

5. **Import Database**
```bash
mysql -u username -p mmid_production < database.sql
```

6. **Jalankan Migrasi (Opsional)**
```bash
php artisan migrate
```

7. **Jalankan Server**
```bash
php artisan serve
```

## 📝 Penggunaan Sistem

### Untuk Manajer Produksi

1. **Membuat Jadwal Produksi**
```php
// Contoh data jadwal produksi
$schedule = [
    'title' => 'Produksi Bumper Depan Avanza',
    'description' => 'Produksi bumper depan untuk Toyota Avanza',
    'start_time' => '2025-07-23 08:00:00',
    'end_time' => '2025-07-25 17:00:00',
    'production_line' => 'Line A',
    'target_quantity' => 500,
    'status' => 'pending'
];
```

2. **Menugaskan Pekerja**
```php
// Contoh penugasan
$task = [
    'title' => 'Persiapan Material',
    'description' => 'Menyiapkan material untuk produksi',
    'production_schedule_id' => 1,
    'assigned_to' => 5, // ID pekerja
    'due_date' => '2025-07-23 10:00:00',
    'priority' => 3
];
```

### Untuk Pekerja Pabrik

1. **Memperbarui Status Tugas**
   - Login ke sistem
   - Pilih tugas yang ditetapkan
   - Ubah status: Pending → In-Progress → Completed

2. **Membuat Laporan Harian**
   - Akses menu "Buat Laporan"
   - Pilih jenis "Daily"
   - Isi detail produksi dan catatan

## 📊 Laporan dan Analitik

### Jenis Laporan yang Tersedia

1. **Laporan Harian Produksi**
   - Target vs pencapaian harian
   - Efisiensi per lini produksi
   - Kendala dan solusi

2. **Laporan Kualitas**
   - Tingkat defect per batch
   - Analisis penyebab cacat
   - Tindakan perbaikan

3. **Laporan Insiden**
   - Dokumentasi masalah produksi
   - Analisis penyebab
   - Tindakan preventif

4. **Laporan Pemeliharaan**
   - Jadwal maintenance rutin
   - Perbaikan darurat
   - Status peralatan

## 🔐 Keamanan

- Sistem autentikasi berbasis role
- Password terenkripsi menggunakan bcrypt
- Token akses untuk API (personal_access_tokens)
- Audit trail untuk aktivitas pengguna


## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE) - lihat file LICENSE untuk detail.

## 📞 Kontak

- **Project Dev**: [Hosea Oktarivanes]
- **Email**: hoseaoktarivanes@gmail.com

---

**Last Updated**: July 22, 2025  
**Database Version**: Generated July 1, 2025 at 08:05 AM  
