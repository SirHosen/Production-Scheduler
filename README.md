# 📦 Sistem Manajemen Produksi MMID

![Status](https://img.shields.io/badge/status-active-success.svg)
![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.2.28-777BB4?logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.0.42-4479A1?logo=mysql\&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-Framework-FF2D20?logo=laravel\&logoColor=white)

> Sistem Manajemen Produksi berbasis web untuk industri manufaktur modern.
> Dibangun menggunakan Laravel & MySQL, sistem ini mendukung manajemen jadwal produksi, kontrol kualitas, pelaporan, serta kolaborasi antar-departemen.

---

## 📋 Deskripsi Proyek

Sistem ini dirancang untuk meningkatkan efisiensi dan koordinasi dalam proses produksi melalui otomasi tugas, penjadwalan, pelaporan, serta kontrol kualitas yang terintegrasi.

### 🎯 Tujuan

* 📅 Otomatisasi penjadwalan produksi
* 🤝 Kolaborasi lintas departemen
* 📈 Pelaporan real-time
* ⚙️ Optimasi alur produksi
* 🧪 Kontrol kualitas terpusat

---

## 🏗️ Arsitektur Sistem

### Skema Database (Simplifikasi)

```
users ←→ roles
  ↓
departments
  ↓
production_schedules ←→ tasks
  ↓
reports
```

### Entitas Kunci

* **Users**: Otentikasi & peran
* **Departments**: Unit produksi
* **Production Schedules**: Jadwal produksi
* **Tasks**: Tugas-tugas kerja
* **Reports**: Laporan harian, insiden, kualitas, pemeliharaan

---

## 🚀 Fitur Utama

### 👨‍💼 Administrator

* Kelola pengguna & peran
* Konfigurasi sistem & departemen

### 👨‍🏭 Manajer Produksi

* Kelola jadwal produksi
* Tetapkan tugas & pantau kemajuan
* Buat laporan produksi & kualitas

### 👷‍♂️ Pekerja Pabrik

* Lihat jadwal & tugas
* Perbarui status tugas
* Buat laporan harian & insiden

---

## 🖼️ 📷 Screenshots

| Halaman                | Tangkapan Layar                                                                                                                         |
| ---------------------- | --------------------------------------------------------------------------------------------------------------------------------------- |
| **🔐 Login**           | <img src="https://github.com/user-attachments/assets/712f8ef6-7bee-408c-be21-ed858bfce416" alt="Halaman Login" width="100%" />          |
| **📊 Dashboard**       | <img src="https://github.com/user-attachments/assets/c721f563-0c6f-4bef-b47a-b11380ead40c" alt="Dashboard Awal" width="100%" />         |
| **📅 Jadwal Produksi** | <img src="https://github.com/user-attachments/assets/9b05eccc-91ff-4ae8-8483-29f178de611a" alt="Tab Jadwal Produksi" width="100%" />    |
| **📋 Tugas**           | <img src="https://github.com/user-attachments/assets/68ef9174-352c-4fae-8674-ae8d2f7b53fa" alt="Tab Manajemen Tugas" width="100%" />    |
| **👥 Pengguna**        | <img src="https://github.com/user-attachments/assets/12948021-4603-41f5-ac6d-7b806a4dc0e1" alt="Tab Manajemen Pengguna" width="100%" /> |
| **📝 Laporan**         | <img src="https://github.com/user-attachments/assets/55550ca4-7925-4db4-a2e6-d70d654c85d5" alt="Tab Laporan" width="100%" />            |

---

## 🛠️ Teknologi Digunakan

| Komponen | Teknologi                 |
| -------- | ------------------------- |
| Backend  | PHP 8.2.28, Laravel       |
| Database | MySQL 8.0.42              |
| Server   | Ubuntu 22.04.1            |
| Tool Dev | Composer, npm, phpMyAdmin |

---

## 🔧 Instalasi

### Prasyarat

* PHP >= 8.2
* MySQL >= 8.0
* Composer & Node.js

### Langkah-langkah

```bash
# 1. Clone repository
git clone https://github.com/username/mmid-production-system.git
cd mmid-production-system

# 2. Install dependensi
composer install
npm install && npm run build

# 3. Copy file konfigurasi dan generate key
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi .env Anda
# (Edit DB_DATABASE, DB_USERNAME, DB_PASSWORD)

# 5. Import database (atau migrate jika pakai fresh DB)
mysql -u root -p mmid_production < database.sql
# php artisan migrate

# 6. Jalankan server
php artisan serve
```

---

## 📊 Diagram Sistem

### 📌 Use Case Diagram

```plaintext
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

### 📌 Entity Relationship Diagram (ERD)

```sql
users (1) ──→ (N) production_schedules
users (1) ──→ (N) tasks
users (1) ──→ (N) reports
production_schedules (1) ──→ (N) tasks
production_schedules (1) ──→ (N) reports
roles (1) ──→ (N) users
departments (1) ──→ (N) users
```

---

## 🔐 Keamanan

* 🔑 Role-based Authentication
* 🔒 Password terenkripsi (bcrypt)
* 🔐 API Token Support
* 🕵️ Audit Trail aktivitas pengguna

---

## 📈 Pelaporan & Analitik

* **Daily Report**: Perbandingan target & realisasi
* **Quality Report**: Analisis cacat produksi
* **Incident Report**: Dokumentasi masalah
* **Maintenance Report**: Status dan jadwal alat

---

## 📄 Lisensi

Distribusi kode ini mengikuti lisensi [MIT License](LICENSE).

---

## 📞 Kontak Pengembang

* **Nama**: Hosea Oktarivanes
* **Email**: [hoseaoktarivanes@gmail.com](mailto:hoseaoktarivanes@gmail.com)

---

**🗓️ Terakhir Diperbarui**: July 22, 2025
**📁 Database Version**: Generated July 1, 2025 @ 08:05 AM

