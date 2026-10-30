<?php
require_once 'koneksi.php';
require_once 'controllers/ProdukController.php';

$controller = new ProdukController($koneksi);
$action = isset($_GET['action']) ? $_GET['action'] : 'index';
$id = isset($_GET['id']) ? $_GET['id'] : null;

switch ($action) {
    case 'create':
        $controller->create();
        break;
    case 'edit':
        if($id) $controller->edit($id);
        break;
    case 'delete':
        if($id) $controller->delete($id);
        break;
    default:
        $controller->index();
        break;
}
?>