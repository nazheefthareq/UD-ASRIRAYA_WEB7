<?php
session_start();
require_once __DIR__ . '/../models/produk.php';
require_once __DIR__ . '/../models/kasir.php';

$produkModel = new Produk();
$transaksiModel = new Kasir();

if (!isset($_SESSION['keranjang'])) $_SESSION['keranjang'] = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_produk'];
    $jumlah = intval($_POST['jumlah'] ?? 1);

    if (isset($_POST['tambah_keranjang'])) {
        $produk = $produkModel->getProdukID($id);
        if ($jumlah > 0 && $jumlah <= $produk['stok_produk']) {
            $_SESSION['keranjang'][$id] = ($_SESSION['keranjang'][$id] ?? 0) + $jumlah;
        }
    }

    if (isset($_POST['ubah_jumlah']) && $jumlah > 0) {
        $_SESSION['keranjang'][$id] = $jumlah;
    }

    if (isset($_POST['hapus_item'])) {
        unset($_SESSION['keranjang'][$id]);
    }

    if (isset($_POST['checkout'])) {
        foreach ($_SESSION['keranjang'] as $id => $jumlah) {
            $produk = $produkModel->getProdukID($id);
            $harga = $produk['harga_jual'];
            $total = $harga * $jumlah;
            $transaksiModel->simpanTransaksi($id, $jumlah, $harga, $total);
            $produkModel->kurangiStok($id, $jumlah);
        }
        $_SESSION['keranjang'] = [];
    }

    header("Location: ../views/admin/kasir/kasir.php"); // Hindari resubmission
    exit();
}

?>