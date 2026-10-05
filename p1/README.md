# README - Praktikum 1 PHP

Nama : Andre Alfre
NPM : 4523210018

- **Program A**: `kalkulator.php`, kalkulator sederhana (tambah, kurang, kali, bagi, dan pangkat).
- **Program B**: `biodata.php`, menampilkan biodata mahasiswa beserta predikat berdasarkan IPK.

> Cara menjalankan: simpan kedua file di folder yang sama, lalu jalankan `php -S localhost:8000` di folder tersebut. Buka `http://localhost:8000/kalkulator.php` dan `http://localhost:8000/biodata.php` di browser.

---

## Program A: Kalkulator

### Bagian yang Dimodifikasi

**1. Operator pangkat (`^`)**

```php
case '^': // menambahkan pangkat
    $hasil = pow($a, $b);
    break;
```

Menambah operasi pangkat. Opsi `^ Pangkat` juga ditambahkan pada elemen `<select>`.

**2. Tampilan (CSS) dan pilihan operator tetap terpilih**

```php
<option value="+" <?= (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : '' ?>>(+ Tambah)</option>
```

Halaman diberi styling (card, warna, tombol hijau, placeholder "Angka pertama" dan "Angka kedua"). Operator yang dipilih tidak kembali ke `+` setelah tombol **Hitung Hasil** ditekan.

### Penjelasan 5 Bagian Kode

| No | Bagian Kode | Penjelasan |
|----|-------------|------------|
| 1 | `($_SERVER['REQUEST_METHOD'] === 'POST')` | Mendeteksi apakah form sudah disubmit atau belum. |
| 2 | `?? 0` | Mencegah error ketika variabel kosong atau belum diinput saat halaman pertama kali dimuat. |
| 3 | `switch ($operator)` | Percabangan untuk mengevaluasi jenis operator matematika yang dipilih. |
| 4 | `htmlspecialchars` | Mencegah celah keamanan (XSS) dengan mengonversi karakter khusus HTML sebelum dicetak kembali. |
| 5 | `if ($b == 0)` | Mencegah error akibat pembagian dengan nol; sebagai gantinya ditampilkan pesan. |

### Error yang Pernah Muncul

**Error:** Hasil/pesan tidak tampil atau muncul parse error pada bagian `elseif`.

**Penyebab:** Penulisan `<?elseif (...): ?>` memakai short tag tanpa `php`. Pada konfigurasi `short_open_tag = Off`, tag ini tidak dikenali.

**Perbaikan:**
1. Ubah menjadi `<?php elseif ($hasil !== null): ?>`.
2. Muat ulang halaman dan coba kembali perhitungannya.

---

## Program B: Biodata

### Bagian yang Dimodifikasi

**1. Penambahan field baru pada array `$mahasiswa`**

```php
'semester' => 6,
'email' => 'andi.pratama@student.ac.id',
'status_keaktifan' => 'Aktif'
```

Menambah field `email` dan `status_keaktifan`, serta mengubah semester dari 1 menjadi 6.

**2. Tampilan (CSS) dan format label**

```php
<strong><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $kunci))) ?>:</strong>
```

Halaman dibuat dalam bentuk card dengan judul "Profil Mahasiswa" dan kotak predikat berwarna hijau. Label dari key array dirapikan: tanda `_` diganti spasi.

### Penjelasan 5 Bagian Kode

| No | Bagian Kode | Penjelasan |
|----|-------------|------------|
| 1 | `statusKelulusan(float $ipk): string` | Mengevaluasi nilai IPK dan mengembalikan predikat otomatis: `>= 3.50` Sangat Memuaskan, `>= 3.00` Memuaskan, selain itu Perlu Peningkatan. |
| 2 | `$mahasiswa` | Array asosiatif (key-value) yang menyimpan informasi penting mahasiswa. |
| 3 | `foreach ($mahasiswa as $kunci => $nilai)` | Perulangan otomatis untuk mencetak seluruh isi array `$mahasiswa`. |
| 4 | `htmlspecialchars` | Mencegah celah keamanan dengan mengubah karakter khusus HTML sebelum ditampilkan. |
| 5 | `ucfirst` + `str_replace` | Membuat huruf pertama key menjadi kapital dan mengganti karakter `_` dengan spasi, sehingga `status_keaktifan` tampil sebagai "Status keaktifan". |

### Error yang Pernah Muncul

**Error:** Label field tampil sebagai `Status_keaktifan:` dengan garis bawah.

**Penyebab:** Key array `status_keaktifan` dicetak langsung dengan `ucfirst()` tanpa mengganti karakter `_`.

**Perbaikan:**
1. Tambahkan `str_replace('_', ' ', $kunci)` sebelum `ucfirst()`.
2. Bungkus hasilnya dengan `htmlspecialchars()` agar tetap aman.
