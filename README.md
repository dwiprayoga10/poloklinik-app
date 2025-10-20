# 🏥 Tugas Laravel — Manajemen Data Dokter

Repositori ini merupakan hasil pengerjaan tugas pengembangan sistem manajemen data **dokter** menggunakan **Laravel**.  
Tugas ini berfokus pada **validasi data**, **update data dokter**, dan **penambahan field baru** di halaman form.

---

## 📋 Instruksi Pengerjaan

### 1️⃣ DokterController.php (Function `update`)
Pada file `app/Http/Controllers/DokterController.php`, dilakukan beberapa perubahan:

- ✅ **Menambahkan validasi request**, agar data yang dikirim saat *edit dokter* sesuai aturan (seperti `required`, `email`, `min`, dll).  
- ✅ **Menambahkan proses update data ke database**, termasuk pengecekan apakah **password diubah** atau tidak.  
  - Jika password **tidak diubah**, maka password lama tetap digunakan.  
  - Jika password **diubah**, maka password baru akan di-*hash* dan disimpan ke database.

**Contoh kode:**

```php
public function update(Request $request, $id)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'email' => 'required|email',
        'no_ktp' => 'required|numeric',
        'no_hp' => 'required|numeric',
        'alamat' => 'required|string',
        'password' => 'nullable|min:6',
    ]);

    $dokter = Dokter::findOrFail($id);
    $dokter->nama = $request->nama;
    $dokter->email = $request->email;
    $dokter->no_ktp = $request->no_ktp;
    $dokter->no_hp = $request->no_hp;
    $dokter->alamat = $request->alamat;

    if ($request->filled('password')) {
        $dokter->password = Hash::make($request->password);
    }

    $dokter->save();

    return redirect()->route('dokter.index')->with('success', 'Data dokter berhasil diperbarui!');
}
```

---

### 2️⃣ Halaman Create Dokter (`create.blade.php`)

Pada file `resources/views/admin/dokter/create.blade.php`, dilakukan perubahan tampilan dan penambahan field baru:

- ➕ **Menambahkan field “No HP”** di samping field **“No KTP”**.
- 🔑 **Menambahkan field “Password”** di **paling akhir form** sebelum tombol **Simpan**.

**Contoh potongan kode:**

```html
<div class="row mb-3">
    <div class="col-md-6">
        <label for="no_ktp" class="form-label">No KTP</label>
        <input type="text" name="no_ktp" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" name="no_hp" class="form-control" required>
    </div>
</div>

<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" placeholder="Masukkan password">
</div>

<button type="submit" class="btn btn-primary">Simpan</button>
```

---

## 🖼️ Contoh Tampilan Form

Berikut contoh tampilan form setelah modifikasi:

```
![Tampilan Form Create Dokter](path/to/screenshot.png)
```

*(Tambahkan screenshot hasil tugas di sini)*

---

## 🧩 Struktur Folder yang Diubah

```
app/
└── Http/
    └── Controllers/
        └── DokterController.php     # Ditambahkan validasi & proses update

resources/
└── views/
    └── admin/
        └── dokter/
            ├── create.blade.php     # Ditambahkan field No HP & Password
            └── edit.blade.php       # Menyesuaikan tampilan update dokter
```

---

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
Mahasiswa Universitas Dian Nuswantoro  
📧 *(tambahkan email jika ingin)*
