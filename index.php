<?php
require_once 'config/database.php';

$conn = connectDB();

// Ambil data kategori produk
$stmtKategori = $conn->prepare("SELECT id_kategori, nama_kategori FROM kategori_produk ORDER BY nama_kategori");
$stmtKategori->execute();
$kategoriList = $stmtKategori->fetchAll(PDO::FETCH_ASSOC);

// Ambil data produk terbaru (6 produk)
$stmtProduk = $conn->prepare("SELECT id_produk, nama_produk, harga_jual FROM stok_produk ORDER BY id_produk DESC LIMIT 6");
$stmtProduk->execute();
$produkList = $stmtProduk->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>UD Asri Raya - Homepage</title>
<style>
    * {
        box-sizing: border-box;
    }
    body {
        margin: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f3fa;
    }
    a {
        text-decoration: none;
        color: inherit;
    }
    nav {
        background-color: #103466;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 10px 20px;
        position: sticky;
        top: 0;
        z-index: 1000;
    }
    .logo-circle {
        width: 40px;
        height: 40px;
        background-color: #FFD23F;
        color: #103466;
        font-weight: 700;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        user-select: none;
    }
    .nav-menu {
        list-style: none;
        margin: 20;
        padding: 0;
        display: flex;
        gap: 70px;
    }
    .nav-menu li a {
        color: white;
        font-weight: 700;
        font-size: 16px;
        padding: 8px 0;
        display: block;
    }
    .nav-menu li a:hover {
        color: #FFD23F;
    }
    /* Banner */
    .banner {
        position: relative;
        height: 350px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: #103466;
        font-weight: 700;
        font-size: 2.5rem;
        text-align: center;
        padding: 0 20px;
        background-image: url('assets/img/background-homepage.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }
    .banner::before {
        content: "";
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: rgba(255, 255, 255, 0.6);
        z-index: 1;
    }
    .banner > * {
        position: relative;
        z-index: 2;
    }
    /* Container */
    .container {
        width: 90%;
        max-width: 1200px;
        margin: 40px auto;
    }
    h5 {
        margin-bottom: 20px;
        color: #103466;
        font-weight: 700;
    }
    /* Section grey */
    .section-grey {
        background-color: #d3d3d3;
        padding: 20px;
        border-radius: 10px;
        margin-bottom: 40px;
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        justify-content: space-between;
    }
    .product-box {
        background-color: white;
        border-radius: 8px;
        padding: 10px;
        text-align: center;
        flex: 1 1 calc(16% - 10px);
        min-width: 140px;
    }
    .product-img-placeholder {
        width: 100%;
        height: 120px;
        background-color: #bbb;
        border-radius: 8px;
        margin-bottom: 10px;
    }
    .product-price {
        font-weight: bold;
        margin-top: 5px;
        text-align: left;
        color: #103466;
    }
    /* Footer */
    footer {
        background-color: #103466;
        color: white;
        text-align: center;
        padding: 20px 0;
        font-size: 14px;
        margin-top: 40px;
    }
    /* Responsive */
    @media (max-width: 900px) {
        .product-box {
            flex: 1 1 calc(33% - 10px);
        }
    }
    @media (max-width: 600px) {
        nav {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
        .nav-menu {
            flex-direction: column;
            width: 100%;
            gap: 10px;
        }
        .product-box {
            flex: 1 1 100%;
        }
    }
</style>
</head>
<body>

<nav>
    <a href="#" class="navbar-brand">
        <div class="logo-circle">
            <img src="assets/img/logo.png" alt="Logo UD Asri Raya" style="height:36px; width:auto; border-radius: 50%;" />
        </div>
    </a>

    <ul class="nav-menu">
        <li><a href="#">Home</a></li>
        <li><a href="#">Article</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>

<section class="banner">
    <div>Solusi Bahan Bangunan<br />Terpercaya di Surabaya</div>
</section>

<div class="container">
    <h5>Kategori</h5>
    <div class="section-grey">
        <?php foreach ($kategoriList as $kategori) : ?>
            <div class="product-box">
                <div class="product-img-placeholder">Kategori</div>
                <div class="product-price"><?= htmlspecialchars($kategori['nama_kategori']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>

    <h5>Brand Produk Kami</h5>
    <div class="section-grey">
        <?php foreach ($produkList as $produk) : ?>
            <div class="product-box">
                <div class="product-img-placeholder">Produk</div>
                <div class="product-price">Rp<?= number_format($produk['harga_jual'], 0, ',', '.') ?></div>
                <div><?= htmlspecialchars($produk['nama_produk']) ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    Copyright 2025 © UD Asri Raya
</footer>

</body>
</html>
