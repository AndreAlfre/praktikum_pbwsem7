<?php
require_once 'models/ProdukModel.php';

class ProdukController {
    private $model;

    public function __construct($koneksi) {
        $this->model = new ProdukModel($koneksi);
    }

    public function index() {
        $data = $this->model->getAll();
        require 'views/produk/index.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->insert($_POST['nama_produk'], $_POST['harga']);
            header("Location: index.php");
        } else {
            require 'views/produk/create.php';
        }
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->model->update($id, $_POST['nama_produk'], $_POST['harga']);
            header("Location: index.php");
        } else {
            $result = $this->model->getById($id);
            $produk = mysqli_fetch_assoc($result);
            require 'views/produk/edit.php';
        }
    }

    public function delete($id) {
        $this->model->delete($id);
        header("Location: index.php");
    }
}
?>