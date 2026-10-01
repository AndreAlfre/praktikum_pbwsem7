# README - Database  (MySQL)

Nama : Andre Alfre
NPM : 4523210018

- **Program A**: pembuatan database `akademik` dan tabel `mahasiswa`, `dosen`, `mata_kuliah`.
- **Program B**: pembuatan tabel `krs` (Kartu Rencana Studi).

> Urutan eksekusi: jalankan **Program A dulu**, baru **Program B**.

---

## Program A

### Bagian yang Dimodifikasi

**1. Kolom `status_mhs` pada tabel `mahasiswa`**

```sql
status_mhs ENUM('aktif','cuti','lulus','keluar') NOT NULL DEFAULT 'aktif',
```

Menambah kolom status agar kondisi mahasiswa tercatat. Nilai bawaannya `aktif`.

**2. Constraint `chk_sks` pada tabel `mata_kuliah`**

```sql
CONSTRAINT chk_sks CHECK (sks BETWEEN 1 AND 6),
```

Membatasi SKS hanya bernilai 1 sampai 6.

### Penjelasan 5 Bagian Kode

| No | Bagian Kode | Penjelasan |
|----|-------------|------------|
| 1 | `CREATE DATABASE IF NOT EXISTS ... utf8mb4` | Membuat database `akademik` hanya jika belum ada, dengan charset yang mendukung karakter Unicode. |
| 2 | `nim VARCHAR(15) PRIMARY KEY` | NIM menjadi identitas unik tiap mahasiswa. Nilainya tidak boleh kosong atau kembar. |
| 3 | `email ... NOT NULL UNIQUE` | Email wajib diisi dan tidak boleh sama antar mahasiswa. |
| 4 | `CHECK (ipk BETWEEN 0.00 AND 4.00)` | Membatasi IPK hanya 0 sampai 4. Tipe `DECIMAL(3,2)` menyimpan dua angka desimal. |
| 5 | `FOREIGN KEY (nidn) ... ON DELETE SET NULL` | Menghubungkan mata kuliah ke dosen. Jika dosen dihapus, `nidn` di mata kuliah menjadi NULL (data tidak ikut terhapus). `ON UPDATE CASCADE` membuat perubahan NIDN ikut terbarui. |

### Error yang Pernah Muncul

**Error:** `ERROR 3819: Check constraint 'mahasiswa_chk_1' is violated`

**Penyebab:** Kolom `ipk` diisi dengan 4.50, melebihi batas constraint.

**Perbaikan:**
1. Ubah nilai IPK ke rentang 0.00 sampai 4.00, misalnya `INSERT ... VALUES (..., 3.50)`.
2. Beri nama constraint sendiri (`CONSTRAINT chk_ipk CHECK ...`) agar pesan error lebih jelas.

---

## Program B

### Bagian yang Dimodifikasi

**1. Kolom `created_at` pada tabel `krs`**

```sql
created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
```

Otomatis mencatat waktu KRS dibuat.

**2. Constraint `chk_nilai` pada tabel `krs`**

```sql
CONSTRAINT chk_nilai CHECK (nilai_huruf IS NULL
    OR nilai_huruf IN ('A','AB','B','BC','C','D','E')),
```

Nilai huruf hanya boleh A, AB, B, BC, C, D, E, atau NULL (belum dinilai).

### Penjelasan 5 Bagian Kode

| No | Bagian Kode | Penjelasan |
|----|-------------|------------|
| 1 | `id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY` | ID baris KRS terisi otomatis dan bertambah terus, tanpa nilai negatif. |
| 2 | `nim`, `kode_mk`, `semester`, `tahun_ajaran` | Kolom wajib (`NOT NULL`) yang menjelaskan siapa mengambil mata kuliah apa, pada semester dan tahun ajaran berapa. |
| 3 | `nilai_huruf CHAR(2) NULL` | Nilai boleh kosong karena saat KRS diisi, nilai belum keluar. |
| 4 | `UNIQUE (nim, kode_mk, semester, tahun_ajaran)` | Mencegah mahasiswa mengambil mata kuliah yang sama dua kali pada semester dan tahun ajaran yang sama. |
| 5 | Dua `FOREIGN KEY` | `fk_krs_mahasiswa` memakai `ON DELETE CASCADE`: jika mahasiswa dihapus, KRS-nya ikut terhapus. `fk_krs_mk` memakai `ON DELETE RESTRICT`: mata kuliah yang sudah dipakai di KRS tidak bisa dihapus. |

### Error yang Pernah Muncul

**Error:** `ERROR 1215 (HY000): Cannot add foreign key constraint`

**Penyebab:** Program B dijalankan sebelum tabel `mahasiswa` dan `mata_kuliah` dibuat, atau tanpa `USE akademik;`.

**Perbaikan:**
1. Jalankan Program A lebih dulu.
2. Jalankan `USE akademik;`.
3. Jalankan Program B.
4. Pastikan tipe data kolom FK (`VARCHAR(15)` dan `VARCHAR(12)`) sama persis dengan kolom yang dirujuk.
