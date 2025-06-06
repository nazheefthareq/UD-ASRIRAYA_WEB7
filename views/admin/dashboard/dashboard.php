<?php
    require_once __DIR__ ."/../../../models/produk.php";
    require_once __DIR__ ."/../../../models/artikel.php";
    require_once __DIR__ ."/../../../models/laporan.php";

    $produkmodel = new Produk();
    $artikelmodel = new Artikel();
    $laporanmodel = new Laporan();
    $totalproduk = $produkmodel->countProduk();
    $totalartikel = $artikelmodel->countArtikel();
    $totallaporan = $laporanmodel->getTotalPenjualanHariIni();
    $produklima = $produkmodel->getlimabarang();
    $artikellima = $artikelmodel->getlimaartikel();
    $laporanlima = $laporanmodel->getlimalaporan();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        body {
            background-color: #F4F6FF;
            font-family: Plus Jakarta Sans;
        }

        .sidebar .logo {
            color: #F3C623;
        }

        .sidebar {
            height: 100vh;
            background-color: #10375C;
            color: #fff;
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            color: #F3C623;
        }

        .info-card {
            background-color: #10375C;
            color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }

        .info-card h3 {
            font-weight: bold;
        }

        .table thead th {
            background-color: #10375C;
            color: #F3C623;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <?php include "../includes/sidebar.php" ?>
            <!-- Main Content -->
            <div class="col-md-10 p-4">
                <h2 class="mb-4 fw-bold">Selamat Datang di Sistem Admin Asri Raya</h2>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= $totalproduk ?></h3>
                            <p>Total Barang</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= $totalartikel ?></h3>
                            <p>Total Artikel</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= number_format($totallaporan, 0, ',', '.')  ?></h3>
                            <p>Penjualan Hari ini</p>
                        </div>
                    </div>
                </div>

                <h2 class="mb-4 fw-bold">Daftar Barang</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($produklima as $row): ?>
                        <tr>
                            <td><?php echo $row['nama_produk'] ?></td>
                            <td><?php echo $row['nama_kategori'] ?></td>
                            <td><?php echo $row['satuan'] ?></td>
                            <td><?php echo $row['harga_jual'] ?></td>
                            <td><?php echo $row['stok_produk'] ?></td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>

                <h2 class="mb-4 fw-bold">Daftar Artikel</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Tanggal Publish</th>
                            <th>Gambar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($artikellima)): ?>
                            <?php foreach ($artikellima as $artikel): ?>
                            <tr>
                                <td><?= $artikel['judul_artikel'] ?></td>
                                <td><?= $artikel['tanggal_publish'] ?></td>
                                <td><img src="../../../uploads/<?= $artikel['gambar'] ?>" width="80"></td>
                            </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data artikel.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>

                <h2 class="mb-4 fw-bold">Daftar Laporan Transaksi</h2>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Jumlah Produk</th>
                            <th>Harga Satuan</th>
                            <th>Total Harga</th>
                            <th>Tanggal Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($laporanlima)): ?>
                            <?php foreach ($laporanlima as $laporan): ?>
                                <tr>
                                    <td><?= $laporan['nama_produk'] ?></td>
                                    <td><?= $laporan['jumlah_produk'] ?></td>
                                    <td>Rp <?= number_format($laporan['harga_satuan'], 0, ',', '.') ?></td>
                                    <td>Rp <?= number_format($laporan['total_harga'], 0, ',', '.') ?></td>
                                    <td><?= date('Y-m-d', strtotime($laporan['tanggal_transaksi'])) ?></td>
                                </tr>
                            <?php endforeach ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">Tidak ada data transaksi.</td>
                            </tr>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>