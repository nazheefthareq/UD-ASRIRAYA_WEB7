<?php

require_once 'config.php';
require_once ('kasirmodel.php');

// Tambah ke keranjang
if (isset($_POST['tambah_keranjang'])) {
    $id = $_POST['id_produk'];
    $jumlah = intval($_POST['jumlah']);
    $produk = getProdukById($conn, $id);

    if ($jumlah > 0 && $jumlah <= $produk['stok_produk']) {
        $_SESSION['keranjang'][$id] = ($_SESSION['keranjang'][$id] ?? 0) + $jumlah;
    }
}

// Ubah jumlah
if (isset($_POST['ubah_jumlah'])) {
    $id = $_POST['id_produk'];
    $jumlah = intval($_POST['jumlah']);

    // Ambil data stok dari database
    $query = $conn->query("SELECT stok_produk FROM stok_produk WHERE id_produk = '$id'");
    $data = $query->fetch_assoc();
    $stok = $data['stok_produk'];

    if ($jumlah > 0) {
        if ($jumlah <= $stok) {
            $_SESSION['keranjang'][$id] = $jumlah;
        }
    }
}


// Hapus item
if (isset($_POST['hapus_item'])) {
    $id = $_POST['id_produk'];
    unset($_SESSION['keranjang'][$id]);
}

// Checkout
if (isset($_POST['checkout'])) {
    $tanggal = date('Y-m-d');
    foreach ($_SESSION['keranjang'] as $id => $jumlah) {
        $produk = getProdukById($conn, $id);
        $harga = $produk['harga_jual'];
        $total = $harga * $jumlah;

        simpanTransaksi($conn, $id, $jumlah, $harga, $tanggal, $total);
        kurangiStok($conn, $id, $jumlah);
    }
    unset($_SESSION['keranjang']);
}

include ('kasirview.php');
?>
