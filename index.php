<?php
require_once 'config/database.php'; // koneksi DB
$conn = connectDB();

// Ambil data kategori produk (jika ada)
$queryKategori = "SELECT id_kategori, nama_kategori FROM kategori_produk ORDER BY nama_kategori";
$resultKategori = $conn->query($queryKategori);

// Ambil data produk (contoh ambil 6 produk terbaru)
$queryProduk = "SELECT id_produk, nama_produk, harga_jual FROM stok_produk ORDER BY id_produk DESC LIMIT 6";
$resultProduk = $conn->query($queryProduk);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UD Asri Raya - Homepage</title>
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body { background-color: #f0f3fa; }
        .navbar-custom { background-color: #103466; }
        .navbar-custom .navbar-brand, .navbar-custom .nav-link { color: white; }
        .banner {
            background-image: url('assets/img/banner.jpg');
            background-size: cover; background-position: center;
            height: 350px; display: flex; align-items: center; justify-content: center;
            color: #103466; font-weight: 700; font-size: 2.5rem; text-align: center; padding: 0 15px;
        }
        .section-grey {
            background-color: #d3d3d3; padding: 20px; border-radius: 10px; margin-bottom: 40px;
        }
        .product-box {
            background-color: white; border-radius: 8px; padding: 10px; text-align: center; margin: 5px;
        }
        .product-price { font-weight: bold; margin-top: 5px; text-align: left; }
        .product-img-placeholder {
            width: 100%; height: 120px; background-color: #bbb; border-radius: 8px; margin-bottom: 10px;
        }
        .desc-img-placeholder { width: 100%; height: 150px; background-color: #bbb; border-radius: 8px; }
        .desc-section { margin-bottom: 40px; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">
        <a class="navbar-brand" href="#">AR.</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon" style="color:white;"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Article</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="banner">
    Solusi Bahan Bangunan<br />Terpercaya di Surabaya
</section>

<div class="container mt-5">
    <h5>Kategori</h5>
    <div class="section-grey d-flex justify-content-between flex-wrap">
        <?php while ($kategori = $resultKategori->fetch_assoc()) : ?>
            <div class="product-box col-5 col-md-2">
                <div class="product-img-placeholder">Kategori</div>
                <div class="product-price"><?= htmlspecialchars($kategori['nama_kategori']) ?></div>
            </div>
        <?php endwhile; ?>
    </div>

    <h5>Brand Produk Kami</h5>
    <div class="section-grey d-flex justify-content-between flex-wrap">
        <?php while ($produk = $resultProduk->fetch_assoc()) : ?>
            <div class="product-box col-5 col-md-2">
                <div class="product-img-placeholder">Produk</div>
                <div class="product-price">Rp<?= number_format($produk['harga_jual'], 0, ',', '.') ?></div>
                <div><?= htmlspecialchars($produk['nama_produk']) ?></div>
            </div>
        <?php endwhile; ?>
    </div>

    <!-- Deskripsi Produk bisa statis seperti sebelumnya -->

</div>

<footer class="text-center py-4" style="background-color: #103466; color: white;">
    Copyright 2025 © UD Asri Raya
</footer>

<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
