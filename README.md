# Sistem Informasi Poliklinik Bengkod

Aplikasi **Sistem Informasi Poliklinik Bengkod** adalah proyek berbasis web yang dibuat menggunakan **Laravel** dengan **Tailwind CSS** sebagai frontend framework. Sistem ini dirancang untuk mempermudah proses administrasi, pelayanan medis, dan pendaftaran pasien di lingkungan klinik atau poliklinik.

---

## Fitur Utama

### Admin
- Mengelola data **dokter**, **pasien**, dan **poli**.
- Mengatur jadwal periksa dokter.
- Melihat laporan data pendaftaran dan pemeriksaan pasien.
- CRUD data master (poli, user, jadwal, rekam medis).

### Dokter
- Melihat jadwal praktik pribadi.
- Melihat daftar pasien yang terdaftar pada jadwalnya.
- Mengisi hasil pemeriksaan pasien.
- Menambahkan diagnosa dan resep obat.

### Pasien
- Melakukan **pendaftaran online** ke poli yang diinginkan.
- Melihat riwayat pemeriksaan dan hasil diagnosa.
- Melihat informasi jadwal dokter.

---

##  Teknologi yang Digunakan

| Komponen | Teknologi |
|----------|------------|
| Backend  | Laravel 10 |
| Database | MySQL |
| Server | PHP >= 8.1 |

---

##  Cara Instalasi dan Menjalankan Aplikasi

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lokal Anda:

### 1. Clone Repository
```bash
git clone https://github.com/dwiprayoga10/poloklinik-app.git
cd poloklinik-app
```

### 2. Install Dependency
```bash
composer install
npm install
npm run dev
```

### 3. Buat File Environment
Salin file `.env.example` menjadi `.env`
```bash
cp .env.example .env
```

### 4. Konfigurasi Database
Buka file `.env` dan ubah pengaturan sesuai dengan database lokal Anda:
```
DB_DATABASE=poliklinik_db
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generate Key dan Migrasi Database
```bash
php artisan key:generate
php artisan migrate --seed
```

### 6. Jalankan Server
```bash
php artisan serve
```

Akses aplikasi melalui:  
http://localhost:8000

---

## Akun Default (Seeder)
| Role | Email | Password |
|------|--------|-----------|
| Admin | admin@gmail.com | password |
| Dokter | dokter@gmail.com | password |
| Pasien | pasien@gmail.com | password |

---

## Tampilan Antarmuka
- Dashboard Admin dengan statistik jumlah dokter, pasien, dan poli.
- Halaman Jadwal Dokter untuk melihat dan mengatur jadwal periksa.
- Form Pendaftaran Pasien ke Poli.
- Riwayat Pemeriksaan Pasien dengan hasil diagnosa.

---

## Struktur Folder Penting
```
app/
 ├── Http/
 │    ├── Controllers/
 │    │     ├── Admin/
 │    │     ├── Dokter/
 │    │     ├── Pasien/
 │    │     └── AuthController.php
 │
 ├── Models/
 └── ...
resources/
 ├── views/
 │    ├── admin/
 │    ├── dokter/
 │    ├── pasien/
 │    └── auth/
```

---
