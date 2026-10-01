<?php
// kalkulator.php 
$hasil = null;
$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $a = (float) ($_POST['a'] ?? 0);
    $b = (float) ($_POST['b'] ?? 0);
    $operator = $_POST['operator'] ?? '+';

    switch ($operator) {
        case '+':
            $hasil = $a + $b;
            break;
        case '-':
            $hasil = $a - $b;
            break;
        case '*':
            $hasil = $a * $b;
            break;
        case '/':
            if ($b == 0) {
                $pesan = 'Pembagian dengan nol tidak diperbolehkan.';
            } else {
                $hasil = $a / $b;
            }
            break;
        case '^': //menambahkan pangkat
            $hasil = pow($a, $b);
            break;
        default:
            $pesan = 'Operator tidak valid.';
    }
}
?>
<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Kalkulator Modifikasi</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; padding: 40px; text-align: center; }
        .card { background: white; max-width: 400px; margin: 0 auto; padding: 20px; border-radius: 8px; box-shadow: 0px 4px 8px rgba(0,0,0,0.1); }
        input, select, button { padding: 10px; margin: 8px 0; font-size: 16px; }
        button { background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
        button:hover { background-color: #45a049; }
        .result { font-weight: bold; color: #333; margin-top: 15px; font-size: 18px; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Kalkulator </h2>
        <form method="post">
            <input type="number" step="any" name="a" placeholder="Angka pertama" required style="width: 80%;"><br>
            <select name="operator" style="width: 85%;">
                <option value="+" <?= (isset($_POST['operator']) && $_POST['operator'] == '+') ? 'selected' : '' ?>>(+ Tambah)</option>
                <option value="-" <?= (isset($_POST['operator']) && $_POST['operator'] == '-') ? 'selected' : '' ?>>(- Kurang)</option>
                <option value="*" <?= (isset($_POST['operator']) && $_POST['operator'] == '*') ? 'selected' : '' ?>>(* Kali)</option>
                <option value="/" <?= (isset($_POST['operator']) && $_POST['operator'] == '/') ? 'selected' : '' ?>>(/ Bagi)</option>
                <option value="^" <?= (isset($_POST['operator']) && $_POST['operator'] == '^') ? 'selected' : '' ?>>(^ Pangkat)</option> <!-- Modifikasi Opsi -->
            </select><br>
            <input type="number" step="any" name="b" placeholder="Angka kedua" required style="width: 80%;"><br>
            <button type="submit">Hitung Hasil</button>
        </form>
        
        <?php if ($pesan): ?>
            <p style="color: red;"><?= htmlspecialchars($pesan) ?></p>
        <?elseif ($hasil !== null): ?>
            <div class="result">Hasil: <?= htmlspecialchars((string)$hasil) ?></div>
        <?php endif; ?>
    </div>
</body>
</html>