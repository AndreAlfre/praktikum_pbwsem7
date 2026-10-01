<?php
// biodata.php 
function statusKelulusan(float $ipk): string
{
    if ($ipk >= 3.50) return 'Sangat Memuaskan';
    if ($ipk >= 3.00) return 'Memuaskan';
    return 'Perlu Peningkatan';
}

$mahasiswa = [
    'nim' => '2026001',
    'nama' => 'Andi Pratama',
    'prodi' => 'Teknik Informatika',
    'semester' => 6, 
    'ipk' => 3.72,
    'email' => 'andi.pratama@student.ac.id', // email
    'status_keaktifan' => 'Aktif'             // Status
];
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title>Biodata Mahasiswa</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #eef2f3; padding: 40px; display: flex; justify-content: center; }
        .card { background: #ffffff; width: 400px; padding: 30px; border-radius: 12px; box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
        h1 { color: #2c3e50; font-size: 22px; text-align: center; border-bottom: 2px solid #ecf0f1; padding-bottom: 10px; margin-bottom: 20px; }
        ul { list-style-type: none; padding: 0; }
        ul li { padding: 10px 0; border-bottom: 1px solid #f1f2f6; font-size: 15px; color: #333; display: flex; justify-content: space-between; }
        ul li strong { color: #7f8c8d; text-transform: capitalize; }
        .predikat { background-color: #27ae60; color: white; padding: 12px; text-align: center; border-radius: 6px; margin-top: 20px; font-weight: bold; }
    </style>
</head>

<body>
    <div class="card">
        <h1>Profil Mahasiswa</h1>
        <ul>
            <?php foreach ($mahasiswa as $kunci => $nilai): ?>
                <li>
                    <strong><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $kunci))) ?>:</strong>
                    <span><?= htmlspecialchars((string)$nilai) ?></span>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="predikat">
            Predikat: <?= statusKelulusan($mahasiswa['ipk']) ?>
        </div>
    </div>
</body>

</html>