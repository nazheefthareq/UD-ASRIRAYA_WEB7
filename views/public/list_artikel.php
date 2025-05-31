<?php
require_once __DIR__ . '/../../controllers/artikelController.php';

$controller = new ArtikelController();
$artikelList = $controller->getAllArtikel();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Artikel - UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="#">UD Asri Raya</a>
    </div>
</nav>

<div class="container my-5">
    <h1 class="mb-4 text-primary">Daftar Artikel</h1>

    <?php if (count($artikelList) > 0): ?>
        <div class="list-group">
        <?php foreach ($artikelList as $artikel): ?>
            <a href="detail_artikel.php?id=<?= $artikel['id_artikel'] ?>" class="list-group-item list-group-item-action">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1"><?= htmlspecialchars($artikel['judul_artikel']) ?></h5>
                <small><?= date('d M Y', strtotime($artikel['tanggal_publish'])) ?></small>
            </div>
            <p class="mb-1 text-truncate"><?= htmlspecialchars(substr($artikel['isi_artikel'], 0, 150)) ?>...</p>
            </a>
        <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Tidak ada artikel ditemukan.</p>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
