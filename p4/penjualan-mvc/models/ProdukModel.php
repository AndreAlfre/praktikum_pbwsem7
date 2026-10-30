<?php
class ProdukModel {
    private $koneksi;

    public function __construct($koneksi) {
        $this->koneksi = $koneksi;
    }

    public function getAll() {
        return mysqli_query($this->koneksi, "SELECT * FROM produk");
    }

    public function getById($id) {
        return mysqli_query($this->koneksi, "SELECT * FROM produk WHERE id = $id");
    }

    public function insert($nama, $harga) {
        $query = "INSERT INTO produk (nama_produk, harga) VALUES ('$nama', '$harga')";
        return mysqli_query($this->koneksi, $query);
    }

    public function update($id, $nama, $harga) {
        $query = "UPDATE produk SET nama_produk='$nama', harga='$harga' WHERE id=$id";
        return mysqli_query($this->koneksi, $query);
    }

    public function delete($id) {
        return mysqli_query($this->koneksi, "DELETE FROM produk WHERE id=$id");
    }
}
?>