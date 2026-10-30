<!DOCTYPE html>
<html>
<head><title>Edit Produk</title></head>
<body>
    <h2>Edit Produk</h2>
    <form method="POST" action="index.php?action=edit&id=<?= $produk['id'] ?>">
        <label>Nama Produk:</label><br>
        <input type="text" name="nama_produk" value="<?= $produk['nama_produk'] ?>" required><br><br>
        
        <label>Harga:</label><br>
        <input type="number" name="harga" value="<?= $produk['harga'] ?>" required><br><br>
        
        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>