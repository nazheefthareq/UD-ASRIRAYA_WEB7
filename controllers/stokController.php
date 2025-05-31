<?php
    require_once __DIR__ . '/../models/produk.php';

    $produkModel = new Produk();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // ambil data umum dari form
    $id = $_POST['id'];
    $kategori = $_POST['kategori'];
    $nama = $_POST['namaBarang'];
    $satuan = $_POST['satuan'];
    $harga_jual = $_POST['hargaJual'];
    $stok = $_POST['jumlahStok'];
    $tanggal = date('Y-m-d H:i:s');

    if(isset($_POST['tambah'])){
        $produkModel->tambahProduk($kategori,$nama,$satuan,$harga_jual,$stok,$tanggal);
        header("Location: ../views/admin/manajemen_stok/manajemen_stok.php");
        exit();
    }

    if(isset($_POST['update'])){
        $produkModel->updateProduk($id,$kategori, $nama, $satuan, $harga_jual, $stok, $tanggal);
        header("Location: ../views/admin/manajemen_stok/manajemen_stok.php");
        exit();
    }

    if(isset($_POST['hapus'])){
        $produkModel->hapusProduk($id);
        header("Location: ../views/admin/manajemen_stok/manajemen_stok.php");
        exit();
    }
    }
?>