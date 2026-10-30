<!DOCTYPE html>
<html>
<head><title>Tambah Produk</title></head>
<body>
    <h2>Tambah Produk</h2>
    <form method="POST" action="index.php?action=create">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" required><br><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" required><br><br>
        
        <button type="submit">Simpan</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>