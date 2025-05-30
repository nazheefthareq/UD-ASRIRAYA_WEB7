<?php
    require_once __DIR__ . '/../../../models/laporan.php';
    $laporanModel = new Laporan();
    $laporanList = $laporanModel->getAllLaporan();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        body {
            background-color: #F4F6FF;
            font-family: Plus Jakarta Sans;
        }
        .sidebar .logo{
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
        .table thead th{
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
            <h2 class="mb-4 fw-bold">Laporan Pemasukan</h2>

            <!-- Informasi Kartu -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <h3 style="color: #F3C623">278.456.200</h3>
                        <p>Total Pemasukan</p>
                    </div>
                </div>

</body>
</html>