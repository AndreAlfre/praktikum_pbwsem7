# README - Aplikasi CRUD Mahasiswa (PHP & MySQL)

Nama : Andre Alfre
NPM  : 4523210018

Proyek ini adalah aplikasi web sederhana untuk mengelola data mahasiswa (*Create, Read, Update, Delete*) berbasis PHP Native yang terhubung dengan database MySQL dan dipercantik menggunakan framework Tailwind CSS.

> **Prasyarat**: Pastikan MySQL/XAMPP sudah menyala dan database `akademik` beserta tabel `mahasiswa` sudah dibuat menggunakan Program A sebelumnya.

---

## Struktur File Proyek

Berikut adalah berkas-berkas utama yang digunakan dalam praktikum kali ini:
* **`koneksi.php`**: Mengatur penghubung sistem PHP ke database MySQL.
* **`index.php`**: Halaman utama yang menampilkan tabel seluruh data mahasiswa.
* **`create.php`**: Halaman formulir untuk menambah data mahasiswa baru.
* **`store.php`**: Proses latar belakang untuk memvalidasi dan menyimpan data baru ke database.
* **`edit.php`**: Halaman formulir untuk mengubah data mahasiswa yang sudah ada berdasarkan NIM.
* **`update.php`**: Proses latar belakang untuk memperbarui data hasil edit ke database.
* **`delete.php`**: Proses latar belakang untuk menghapus data mahasiswa berdasarkan NIM.

---

## Penjelasan Bagian Kode Utama

| No | Bagian Kode | Sumber File | Penjelasan |
|----|-------------|-------------|------------|
| 1 | `mysqli_connect($host, $user, $password, $dbname)` | `koneksi.php` | Melakukan jabat tangan (autentikasi) ke server MySQL lokal menggunakan identitas user `root`. |
| 2 | `mysqli_fetch_assoc($query)` | `index.php` | Mengubah baris data mentah hasil SQL menjadi *array* asosiatif PHP agar nama kolomnya bisa dipanggil langsung (contoh: `$data['nama']`). |
| 3 | `window.location.href = 'index.php';` | `store.php` / `delete.php` | Perintah JavaScript untuk mengalihkan (*redirect*) halaman user kembali ke tabel utama secara otomatis setelah aksi berhasil. |
| 4 | `$_GET['nim']` | `edit.php` / `delete.php` | Mengambil parameter NIM yang dikirimkan melalui URL browser untuk menentukan data spesifik mana yang akan dimodifikasi atau dihapus. |
| 5 | `$_SERVER["REQUEST_METHOD"] == "POST"` | `store.php` | Memastikan proses simpan hanya berjalan jika formulir dikirim menggunakan metode POST, guna menghindari akses ilegal langsung lewat URL. |

---

## Error yang Pernah Muncul & Cara Mengatasinya

**1. Error:** `Fatal error: Uncaught TypeError: mysqli_fetch_assoc(): Argument #1 ...`
* **Penyebab:** Fungsi SQL gagal dieksekusi oleh PHP. Biasanya dipicu karena nama tabel atau kolom yang ditulis pada perintah `SELECT * FROM ...` tidak sesuai dengan yang ada di database MySQL.
* **Perbaikan:** Periksa kembali nama tabel di file `index.php` atau `edit.php`, pastikan namanya sama persis huruf besar/kecilnya dengan database Anda.

**2. Error:** `Koneksi gagal: Unknown database 'akademik'`
* **Penyebab:** Nilai `$dbname` pada `koneksi.php` mengarah ke database yang belum dibuat di phpMyAdmin.
* **Perbaikan:** Jalankan terlebih dahulu script SQL pembuatan database `akademik` di MySQL Anda, atau sesuaikan nama database di variabel proyek.

---

## Bukti Hasil Running (Screenshot)

### 1. Halaman Utama (Tabel Data Mahasiswa - `index.php`)
Berikut adalah tampilan tabel utama yang mengambil data langsung dari database:
<img width="1919" height="633" alt="image" src="https://github.com/user-attachments/assets/accc27b7-4c5f-4ad4-bc79-ddf0601c923d" />

### 2. Halaman Tambah Data (`create.php`)
Formulir input data mahasiswa baru dengan gaya Tailwind CSS:
<img width="1919" height="430" alt="image" src="https://github.com/user-attachments/assets/ac449da6-a5e5-4d08-9452-fd42c2e6d404" />


### 3. Notifikasi Berhasil Diubah (`update.php`)
Munculnya alert pemberitahuan saat data baru berhasil diubah:
<img width="1551" height="394" alt="image" src="https://github.com/user-attachments/assets/2f34a590-16ed-4a44-bc07-9b16449a7da3" />


### 4. Halaman Edit Data (`edit.php`)
Formulir edit data yang otomatis memuat informasi mahasiswa lama berdasarkan NIM terpilih:
<img width="1586" height="1001" alt="image" src="https://github.com/user-attachments/assets/432303f8-ead1-442f-99c5-9f3fd3d385af" />
