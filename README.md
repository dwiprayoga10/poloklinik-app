# 🏥 Poliklinik App - Laravel

Aplikasi Poliklinik ini dirancang untuk memudahkan pengelolaan layanan kesehatan seperti pendaftaran pasien, penjadwalan periksa, hingga pencatatan hasil pemeriksaan oleh dokter. Aplikasi mendukung autentikasi **multi-role (Admin, Dokter, Pasien)** 

## 🚀 Cara Menjalankan

### 1. Clone & Install
- git clone https://github.com/liliianaa/WebPresentationApp-PWL.git
- cd WebPresentationApp-PWL
- composer install
- cp env .env
- php artisan key:generate
- php artisan serve

### 2. Setup Database

**Atur Koneksi database .env**
- DB_CONNECTION=mysql
- DB_HOST=127.0.0.1
- DB_PORT=3306
- DB_DATABASE=poliklinik_db
- DB_USERNAME=root
- DB_PASSWORD=

**Jalankan Perintah Migrasi di terminal** php spark migrate
