-- Mengubah data
UPDATE mahasiswa
SET ipk = 3.40
WHERE nim = '2025003';

-- Rekap jumlah mahasiswa per prodi
SELECT prodi, COUNT(*) AS jumlah, ROUND(AVG(ipk),2) AS rata_ipk
FROM mahasiswa
GROUP BY prodi
ORDER BY jumlah DESC;

-- Verifikasi sebelum penghapusan
SELECT * FROM mahasiswa WHERE nim = '2025003';
DELETE FROM mahasiswa WHERE nim = '2025003';