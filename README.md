# 🏥 Tugas Laravel — Manajemen Data Dokter

Repositori ini merupakan hasil pengerjaan tugas mata kuliah Bengkel Koding pertemuan ke-3 dengan topik Manajemen Dokter.
Tugas ini berfokus pada penerapan validasi data, proses update data dokter, serta penambahan field baru pada halaman form input data dokter menggunakan framework Laravel..

---

### 1️⃣ DokterController.php (Function `update`)
Pada file `app/Http/Controllers/DokterController.php`, dilakukan beberapa perubahan:

- ✅ **Menambahkan validasi request**, agar data yang dikirim saat *edit dokter* sesuai aturan (seperti `required`, `email`, `min`, dll).  
- ✅ **Menambahkan proses update data ke database**, termasuk pengecekan apakah **password diubah** atau tidak.  
  - Jika password **tidak diubah**, maka password lama tetap digunakan.  
  - Jika password **diubah**, maka password baru akan di-*hash* dan disimpan ke database.

Pada tugas ini, proses update data dokter dilakukan di dalam function update() pada file DokterController.php.
Function ini berfungsi untuk memvalidasi data yang diedit, memperbarui data dokter di database, serta melakukan pengecekan jika password diubah.

Berikut tampilan contoh kode yang telah diimplementasikan:

![Contoh Function Update - DokterController](public/gambar/Screenshot (186))
![Form Create Dokter - Field No HP](public/gambar/Screenshot (185))
![Form Create Dokter - Field Password](public/gambar/Screenshot (184))

![Contoh Function Update - DokterController](poliklinik-app/public/gambar/Screenshot (186))
![Form Create Dokter - Field No HP](poliklinik-app/public/gambar/form_nohp.png)
![Form Create Dokter - Field Password](poliklinik-app/public/gambar/form_password.png)


## ⚙️ Teknologi yang Digunakan
- Laravel 10
- Blade Template
- Bootstrap 5
- MySQL Database

---

## 💡 Catatan Tambahan
- Pastikan sudah menjalankan perintah berikut sebelum testing:
  ```bash
  php artisan migrate
  php artisan serve
  ```
- Jika terdapat error validasi, pastikan field pada form sesuai dengan nama kolom di database.

---

## ✨ Kontributor
**Dwi Prayoga**  
BENGKEL KODING UDINUS
