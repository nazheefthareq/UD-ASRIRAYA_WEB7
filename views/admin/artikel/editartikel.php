<?php
require_once __DIR__ . '/../../../controllers/authController.php'; 
require_once __DIR__ . '/../../../models/artikel.php';
require_once __DIR__ . '/../../../config/database.php';
$conn = connectDB();
$artikelModel = new Artikel();

if (isset($_GET['id'])) {
        $artikel = $artikelModel->getArtikelById($_GET['id']);
    } else {
        header("Location: manajemen_artikel.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Artikel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;700&display=swap');
        body {
            background-color: #10375C;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-white rounded-4 shadow p-5" style="width: 100%; max-width: 700px;">
            <h3 class="fw-bold mb-4">Edit Artikel</h3>
            <form action="../../../controllers/artikelController.php" method="POST" enctype="multipart/form-$artikel">
                <input type="hidden" name="id" value="<?= $artikel['id_artikel'] ?>">
                <input type="hidden" name="gambar_lama" value="<?= $artikel['gambar'] ?>">

                <div class="mb-3">
                    <label class="form-label">Judul Artikel</label>
                    <input type="text" class="form-control" name="judul_artikel" value="<?= htmlspecialchars($artikel['judul_artikel']) ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Isi Artikel</label>
                    <textarea class="form-control" name="isi_artikel" rows="5" required><?= htmlspecialchars($artikel['isi_artikel']) ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gambar (kosongkan jika tidak diubah)</label>
                    <input type="file" class="form-control" name="gambar" accept="image/*">
                    <?php if (!empty($artikel['gambar'])): ?>
                        <img src="../../../uploads/<?= $artikel['gambar'] ?>" alt="gambar" class="img-thumbnail mt-2" width="150">
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Publish</label>
                    <input type="date" class="form-control" name="tanggal_publish" value="<?= $artikel['tanggal_publish'] ?>" required>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="manajemen_artikel.php" class="btn btn-danger px-4">Batal</a>
                    <button type="submit" name="update" class="btn btn-success px-4">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
