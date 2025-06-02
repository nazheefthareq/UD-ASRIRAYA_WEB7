<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($artikel['judul_artikel']) ?> - UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">UD Asri Raya</a>
        </div>
    </nav>

    <div class="container my-5">
    <h1><?= htmlspecialchars($artikel['judul_artikel']) ?></h1>
    <small>Dipublikasikan pada <?= date('d M Y', strtotime($artikel['tanggal_publish'])) ?></small>
        <div class="mt-4">
            <?= nl2br(htmlspecialchars($artikel['isi_artikel'])) ?>
        </div>
        <div class="mt-3">
            <a href="artikel.php?action=index" class="btn btn-secondary">Kembali ke Daftar Artikel</a>
        </div>
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
