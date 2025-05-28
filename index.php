<?php
require_once 'config/database.php';

$conn = connectDB();

$stmtKategori = $conn->prepare("SELECT id_kategori, nama_kategori FROM kategori_produk ORDER BY nama_kategori");
$stmtKategori->execute();
$kategoriList = $stmtKategori->fetchAll(PDO::FETCH_ASSOC);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background-color: #f0f3fa;
    }
    
    nav {
      background-color: #103466;
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

    .nav-link {
      color: white !important;
      font-weight: 700;
      font-size: 16px;
      margin-left: 30px;
    }

    .nav-link:hover {
      color: #FFD23F !important;
    }

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
      margin-bottom: 40px;
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

    .section-grey {
      background-color: #d3d3d3;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 40px;
      display: flex;
      flex-wrap: nowrap;
      justify-content: space-between;
      overflow-x: auto;
      gap: 10px;
    }

    .section-grey::-webkit-scrollbar {
      height: 6px;
    }

    .section-grey::-webkit-scrollbar-thumb {
      background-color: #999;
      border-radius: 10px;
    }

    .product-box, .category-box {
      background-color: white;
      border-radius: 8px;
      padding: 10px;
      text-align: center;
      width: 140px;
      flex-shrink: 0;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .product-img-placeholder, .category-img-placeholder {
      width: 100%;
      height: 120px;
      background-color: #bbb;
      border-radius: 8px;
      margin-bottom: 10px;
    }

    .product-price, .category-price {
      font-weight: bold;
      text-align: left;
      color: #103466;
    }

    .desc-section {
      max-width: 1200px;
      margin: 0 auto 40px auto;
      padding: 20px;
    }

    .desc-item {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
      gap: 30px;
    }

    .desc-item.reverse {
      flex-direction: row-reverse;
    }

    .desc-img-placeholder-desc {
      width: 350px;
      height: 200px;
      background-color: #bbb;
      border-radius: 12px;
      flex-shrink: 0;
    }

    .desc-text {
      max-width: 700px;
    }

    .desc-text h3 {
      color: #103466;
      margin-bottom: 15px;
    }

    .desc-text p {
      color: #222;
      line-height: 1.6;
    }
    @media (max-width: 900px) {
      .desc-item {
        flex-direction: column;
        text-align: center;
      }

      .desc-item.reverse {
        flex-direction: column;
      }

      .desc-img-placeholder-desc {
        width: 100%;
        height: 180px;
        margin-bottom: 20px;
      }

      .desc-text {
        max-width: 100%;
      }
    }

    footer {
      background-color: #103466;
      color: white;
      text-align: center;
      padding: 20px 0;
      font-size: 14px;
      margin-top: 40px;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a href="#" class="navbar-brand d-flex align-items-center">
      <div class="logo-circle">
        <img src="assets/img/logo.png" alt="Logo UD Asri Raya" style="height:36px; width:auto; border-radius: 50%;" />
      </div>
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto"> <!-- <-- ms-auto di sini -->
        <li class="nav-item"><a href="#" class="nav-link">Home</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Article</a></li>
        <li class="nav-item"><a href="#" class="nav-link">About</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Contact</a></li>
      </ul>
    </div>
  </div>
</nav>


<section class="banner">
  <div>Solusi Bahan Bangunan<br />Terpercaya di Surabaya</div>
</section>

<div class="container">
  <h5>Kategori</h5>
  <div class="section-grey category-container">
    <?php foreach ($kategoriList as $kategori) : ?>
      <div class="category-box">
        <div class="category-img-placeholder"></div>
        <div class="category-price">RpXXXXXX</div>
        <div class="category-name"><?= htmlspecialchars($kategori['nama_kategori']) ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <h5>Brand Produk Kami</h5>
  <div class="section-grey">
    <?php foreach ($produkList as $produk) : ?>
      <div class="product-box">
        <div class="product-img-placeholder"></div>
        <div class="product-price">Rp<?= number_format($produk['harga_jual'], 0, ',', '.') ?></div>
        <div><?= htmlspecialchars($produk['nama_produk']) ?></div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="desc-section">
    <div class="desc-item">
      <div class="desc-img-placeholder-desc"></div>
      <div class="desc-text">
        <h3>Semen</h3>
        <p>
          UD Asri Raya adalah toko bahan bangunan di Surabaya yang menyediakan berbagai jenis semen berkualitas dengan harga bersaing. Kami menjual semen dari merek-merek terpercaya seperti Semen Gresik, Tiga Roda, dan Semen Padang, yang cocok untuk kebutuhan bangunan rumah, renovasi, hingga proyek konstruksi besar. Stok selalu tersedia dan siap kirim ke lokasi Anda.
        </p>
      </div>
    </div>

    <div class="desc-item reverse">
      <div class="desc-img-placeholder-desc"></div>
      <div class="desc-text">
        <h3>Cat Tembok</h3>
        <p>
          UD Asri Raya menyediakan berbagai pilihan cat tembok berkualitas dengan warna tahan lama dan daya rekat tinggi. Kami menjual produk dari merek terpercaya seperti Dulux, Avitex, Nippon Paint, dan Catylac, cocok untuk interior maupun eksterior bangunan. Tersedia dalam berbagai varian warna dan ukuran, siap memenuhi kebutuhan pengecatan rumah, kantor, atau proyek Anda.
        </p>
      </div>
    </div>

    <div class="desc-item">
      <div class="desc-img-placeholder-desc"></div>
      <div class="desc-text">
        <h3>Keramik</h3>
        <p>
          UD Asri Raya menyediakan berbagai jenis keramik berkualitas untuk kebutuhan lantai dan dinding, baik interior maupun eksterior. Kami menjual keramik dari merek-merek terpercaya seperti Roman, Milan, Platinum, dan Asia Tile, dengan beragam motif, ukuran, dan tekstur. Cocok untuk rumah tinggal, kamar mandi, dapur, hingga area komersial. Produk selalu ready stock dengan harga kompetitif dan layanan pengiriman langsung ke lokasi Anda.
        </p>
      </div>
    </div>
  </div>
</div>

<footer>
  Copyright 2025 © UD Asri Raya
</footer>
</body>
</html>
