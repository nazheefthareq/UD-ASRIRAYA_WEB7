<?php
    require_once _DIR_ . '/../../../models/Produk.php';
    session_start();

    $produkModel = new Produk();
    $produkList = $produkModel->getAllProduk();
    $keranjang = $_SESSION['keranjang'] ?? [];
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- CSS Override Styling -->
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
            text-align: center;
        }

        .info-card h3 {
            font-weight: bold;
        }

        .bg-utama {
            background-color: #10375C;
        }

        .btn-tambah {
            background-color: #10375C;
            color: #F3C623;
        }

        .btn-tambah:hover {
            background-color: #F3C623;
            color: #10375C;
        }

        .btn-ubah {
            background-color: #F3C623;
            color: #10375C;
        }

        .btn-ubah:hover {
            background-color: #10375C;
            color: #F3C623;
        }

    </style>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <?php include "../includes/sidebar.php"?>

<div class="col-md-10 p-4">
    <h2 class="mb-4 fw-bold">Sistem Kasir</h2>

    <div class="row">
        <?php foreach ($produkList as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= $p['nama_produk'] ?></h5>
                        <p class="card-text">Rp <?= number_format($p['harga_jual']) ?></p>
                        <p class="card-text">Stok: <?= $p['stok_produk'] ?></p>
                        <form method="post" action="../../../controllers/kasirController.php">
                            <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                            <div class="mb-2">
                                <input type="number" name="jumlah" min="1" value="1" class="form-control" style="width: 80px;">
                            </div>
                            <button type="submit" name="tambah_keranjang" class="btn btn-tambah w-100">Tambah</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-utama p-3 text-white">
            <h4 class="mb-0">Keranjang</h4>
        </div>
        <div class="card-body">
            <form method="post" action="../../../controllers/kasirController.php">
                <div class="table-responsive">
                    <table class="table table-bordered align-middle text-center">
                        <thead class="table-secondary">
                            <tr>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $grand_total = 0;
                        foreach ($keranjang as $id => $jumlah):
                            $p = $produkModel->getProdukID($id);
                            $total = $jumlah * $p['harga_jual'];
                            $grand_total += $total;
                        ?>
                            <tr>
                                <td><?= $p['nama_produk'] ?></td>
                                <td class="d-flex justify-content-center align-items-center gap-2">
                                    <input type="hidden" name="id_produk" value="<?= $id ?>">
                                    <input type="number" name="jumlah" value="<?= $jumlah ?>" class="form-control form-control-sm w-50" min="1">
                                    <button name="ubah_jumlah" class="btn btn-sm btn-ubah">Ubah</button>
                                </td>
                                <td>Rp <?= number_format($p['harga_jual']) ?></td>
                                <td>Rp <?= number_format($total) ?></td>
                                <td>
                                    <form method="post" action="../../../controllers/kasirController.php" class="d-inline">
                                        <input type="hidden" name="id_produk" value="<?= $id ?>">
                                        <button name="hapus_item" class="btn btn-sm btn-danger">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach ?>
                            <tr class="table-light fw-bold">
                                <td colspan="3" class="text-end">Total</td>
                                <td>Rp <?= number_format($grand_total) ?></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="text-end">
                    <button name="checkout" class="btn btn-custom-checkout btn-success btn-md mt-3">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>

</div>
</body>

</html>