<?php
require_once __DIR__ . '/../../../controllers/authController.php'; 
require_once __DIR__ . '/../../../models/produk.php';
$produkModel = new Produk();
$keyword = isset($_GET['search']) ? $_GET['search'] : null;
$produkList = $produkModel->getAllProduk($keyword);
$totalproduk = $produkModel->countProduk();
$produkTerbanyak = $produkModel->getProdukStokTerbanyak();
$produkTersedikit = $produkModel->getProdukStokTersedikit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Stok Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            /* background-color: #1D5D9A; */
        }

        .info-card {
            background-color: #10375C;
            color: #fff;
            border-radius: 10px;
            padding: 35px;
            text-align: center;
            min-height: 150px;
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
                <h2 class="mb-4 fw-bold">Stok Barang</h2>

                <!-- Informasi Kartu -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= $totalproduk ?></h3>
                            <p>Jumlah Barang</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= $produkTerbanyak['nama_produk'] ?></h3>
                            <p>Barang Terbanyak</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="info-card">
                            <h3 style="color: #F3C623"><?= $produkTersedikit['nama_produk'] ?></h3>
                            <p>Barang Terendah</p>
                        </div>
                    </div>
                </div>

                <!-- Pencarian dan Tambah -->
                <h2 class="mb-4 fw-bold">Daftar Barang</h2>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <form method="GET" class="mb-3 w-100" style="max-width: 600px;">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Cari nama barang..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                            <button class="btn" style="background-color: #0d2a4c; color: #fff;" type="submit">Cari</button>
                        </div>
                    </form>
                    <a href="tambahproduk.php"><button class="btn" style="background-color: #0d2a4c; color: #fff;">Tambah Barang <strong class="" style="color: #F3C623">+</strong></button></a>
                </div>

                <!-- Tabel -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Barang</th>
                            <th>Kategori</th>
                            <th>Satuan</th>
                            <th>Harga Jual</th>
                            <th>Jumlah Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $produkList->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?php echo $row['nama_produk'] ?></td>
                                <td><?php echo $row['nama_kategori'] ?></td>
                                <td><?php echo $row['satuan'] ?></td>
                                <td><?php echo $row['harga_jual'] ?></td>
                                <td><?php echo $row['stok_produk'] ?></td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <!-- Tombol Edit -->
                                        <a href="editproduk.php?id=<?= $row['id_produk'] ?>" class="btn btn-success btn-sm">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Tombol Hapus (trigger modal) -->
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalHapus<?= $row['id_produk'] ?>">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="modalHapus<?= $row['id_produk'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $row['id_produk'] ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="modalLabel<?= $row['id_produk'] ?>">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah Anda yakin ingin menghapus <strong><?= $row['nama_produk'] ?></strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="../../../controllers/stokController.php" method="POST">
                                                        <input type="hidden" name="id" value="<?= $row['id_produk'] ?>">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endwhile ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>