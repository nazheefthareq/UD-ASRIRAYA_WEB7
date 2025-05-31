<?php
require_once __DIR__ . '/../../../models/laporan.php';

$laporanModel = new Laporan();

if (isset($_GET['filter']) && isset($_GET['dari']) && isset($_GET['sampai'])) {
    $dari_raw = $_GET['dari'];
    $sampai_raw = $_GET['sampai'];

    $date_dari = DateTime::createFromFormat('Y-m-d', $dari_raw);
    $dari = $date_dari ? $date_dari->format('Y-m-d') : null;

    $date_sampai = DateTime::createFromFormat('Y-m-d', $sampai_raw);
    $sampai = $date_sampai ? $date_sampai->format('Y-m-d') : null;

    $laporanList = $laporanModel->getLaporanByTanggal($dari, $sampai);

    $totalPemasukan = 0;
    foreach ($laporanList as $row) {
        $totalPemasukan += $row['total_harga'];
    }
} else {
    $laporanList = $laporanModel->getAllLaporan();
    $totalPemasukan = $laporanModel->getTotalPemasukan();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Laporan Pemasukan</title>
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

        .btn-filter {
            background-color: #F3C623;
            color: #10375C;
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
                <h2 class="mb-4 fw-bold">Laporan Pemasukan</h2>

                <!-- Informasi Kartu -->
                <div class="row mb-4">
                    <div class="col-xl">
                        <div class="info-card py-5">
                            <h3 style="color: #F3C623">Rp <?= number_format($totalPemasukan, 0, ',', '.') ?></h3>
                            <p>Total Pemasukan</p>
                        </div>
                    </div>

                    <!-- Form Filter Tanggal -->
                    <form method="GET" class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="dari" class="form-label">Dari Tanggal</label>
                            <input type="date" name="dari" class="form-control" value="<?= $_GET['dari'] ?? '' ?>">
                        </div>
                        <div class="col-md-4">
                            <label for="sampai" class="form-label">Sampai Tanggal</label>
                            <input type="date" name="sampai" class="form-control" value="<?= $_GET['sampai'] ?? '' ?>">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" name="filter" class="btn btn-success w-100">
                                Filter Tanggal
                            </button>
                        </div>
                    </form>


                    <!-- Tabel Laporan Transaksi Kasir -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered table-striped">
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
                                <?php if (!empty($laporanList)): ?>
                                    <?php foreach ($laporanList as $row): ?>
                                        <tr>
                                            <td><?= $row['nama_produk'] ?></td>
                                            <td><?= $row['jumlah_produk'] ?></td>
                                            <td>Rp <?= number_format($row['harga_satuan'], 0, ',', '.') ?></td>
                                            <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                            <td><?= date('Y-m-d', strtotime($row['tanggal_transaksi'])) ?></td>
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


</body>

</html>