<?php
require_once __DIR__ . '/../../../controllers/authController.php'; 
require_once __DIR__ . '/../../../models/artikel.php';
$artikelModel = new Artikel();
$artikelList = $artikelModel->getAllArtikel();
if (isset($_GET['search']) && !empty(trim($_GET['search']))) {
    $search = trim($_GET['search']);
    $artikelList = $artikelModel->searchArtikel($search);
} else {
    $artikelList = $artikelModel->getAllArtikel();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');

        body {
            background-color: #F4F6FF;
            font-family: 'Plus Jakarta Sans', sans-serif;
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
            padding: 12px 20px;
            display: block;
        }

        .sidebar a:hover {
            color: #F3C623;
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
        <?php include "../includes/sidebar.php"; ?>

        <!-- Main Content -->
        <div class="col-md-10 p-4">
            <h2 class="mb-4 fw-bold">Manajemen Artikel</h2>

            <!-- Tombol Tambah Artikel -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <form method="GET" class="mb-3 w-100" style="max-width: 600px;">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Cari judul artikel..." value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                        <button class="btn" style="background-color: #0d2a4c; color: #fff;" type="submit">Cari</button>
                    </div>
                </form>
                <a href="tambahartikel.php">
                    <button class="btn" style="background-color: #0d2a4c; color: #fff;">Tambah Artikel <strong style="color: #F3C623">+</strong></button>
                </a>
            </div>

            <!-- Tabel Artikel -->
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Judul</th>
                    <th>Tanggal Publish</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($artikelList as $artikel): ?>
                    <tr>
                        <td><?= $artikel['judul_artikel'] ?></td>
                        <td><?= $artikel['tanggal_publish'] ?></td>
                        <td><img src="../../../uploads/<?= $artikel['gambar'] ?>" width="80"></td>
                        <td>
                            <div class="d-flex gap-1">
                                <a href="editartikel.php?id=<?= $artikel['id_artikel'] ?>" class="btn btn-success btn-sm">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#hapusModal<?= $artikel['id_artikel'] ?>">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>

                            <!-- Modal Hapus -->
                            <div class="modal fade" id="hapusModal<?= $artikel['id_artikel'] ?>" tabindex="-1" aria-labelledby="hapusLabel<?= $artikel['id_artikel'] ?>" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger text-white">
                                            <h5 class="modal-title" id="hapusLabel<?= $artikel['id_artikel'] ?>">Konfirmasi Hapus</h5>
                                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            Yakin ingin menghapus <strong><?= $artikel['judul_artikel'] ?></strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <form action="../../../controllers/artikelController.php" method="POST">
                                                <input type="hidden" name="id" value="<?= $artikel['id_artikel'] ?>">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" name="hapus" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
