<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        body {
            background-color: #f0f2ff;
            font-family: Plus Jakarta Sans;
        }
        .sidebar .logo{
            color: #ffc107;
        }
        .sidebar {
            height: 100vh;
            background-color: #0d2a4c;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }
        .sidebar a:hover {
            color: #ffc107;
        }
        .info-card {
            background-color: #0d2a4c;
            color: #fff;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .info-card h3 {
            font-weight: bold;
        }
        .table thead th{
            background-color: #0d2a4c;
            color: #ffc107;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar p-0">
            <div class="logo p-3 fw-bold fs-5 d-flex gap-3"><img src="logo.png" alt="logo" width="35" height="35">Asri Raya Admin</div>
            <a href="#"class="d-flex gap-2"><i class="bi bi-grid"></i>Dashboard</a>
            <a href="#" class="d-flex gap-2"><i class="bi bi-inbox-fill"></i>Kasir</a>
            <a href="#" class="d-flex gap-2"><i class="bi bi-archive"></i>Stok Barang</a>
            <a href="#" class="d-flex gap-2"><i class="bi bi-clipboard2-data"></i>Laporan Keuangan</a>
            <a href="#" class="d-flex gap-2"><i class="bi bi-journal-text"></i>Manajemen Artikel</a>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4 fw-bold">Stok Barang</h2>

            <!-- Informasi Kartu -->
            <div class="row mb-4">
                <div class="col-md-4">
                    <div class="info-card">
                        <h3 style="color: #ffc107">768</h3>
                        <p>Jumlah Barang</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <h3 style="color: #ffc107">11</h3>
                        <p>Stok Menipis</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="info-card">
                        <h3 style="color: #ffc107">Cat Dinding</h3>
                        <p>Barang Terlaris</p>
                    </div>
                </div>
            </div>

            <!-- Pencarian dan Tambah -->
            <h2 class="mb-4 fw-bold">Daftar Barang</h2>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <input type="text" class="form-control w-50" placeholder="Cari barang...">
                <button class="btn" style="background-color: #0d2a4c; color: #fff;">
                    Tambah Barang <strong>+</strong>
                </button>
            </div>

            <!-- Tabel -->
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Jumlah Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Bootstrap Icon CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

</body>
</html>
