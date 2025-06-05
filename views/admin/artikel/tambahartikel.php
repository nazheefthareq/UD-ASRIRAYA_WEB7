<?php
require_once __DIR__ . '/../../../models/Artikel.php';
$artikelModel = new Artikel();
$edit = false;
$data = ['judul_artikel' => '', 'isi_artikel' => '', 'gambar' => '', 'id_artikel' => ''];

if (isset($_GET['id'])) {
    $data = $artikelModel->getArtikelById($_GET['id']);
    $edit = true;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        body {
            background-color: #10375C;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="bg-white rounded-4 shadow p-5" style="width: 100%; max-width: 700px;">
        <h3 class="fw-bold mb-4">Tambah Artikel</h3>
        <form action="../../../controllers/artikelController.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Judul Artikel</label>
                <input type="text" class="form-control" name="judul_artikel" placeholder="Masukkan judul artikel" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Isi Artikel</label>
                <textarea class="form-control" name="isi_artikel" rows="6" placeholder="Tulis isi artikel di sini..." required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar (opsional)</label>
                <input type="file" class="form-control" name="gambar">
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Publish</label>
                <input type="date" class="form-control" name="tanggal_publish" required>
            </div>

            <div class="d-flex justify-content-end gap-3 mt-4">
                <a href="manajemen_artikel.php" class="btn btn-danger px-4">Batal</a>
                <button type="submit" class="btn btn-success px-4" name="tambah">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

