<?php
require_once __DIR__ . '/../../models/artikel.php';

$controller = new Artikel();
$artikelList = $controller->getAllArtikel();
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Artikel - UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        footer {
            background-color: #f8f9fa;
            padding: 20px 0;
            text-align: center;
        }

        /* Navbar styling */
        .navbar-custom {
            background-color: #10375C;
            z-index: 1020;
        }


        .navbar-custom .navbar-nav .nav-link {
            color: #f8f9fa;
        }

        .navbar-custom .navbar-nav .nav-link.active,
        .navbar-custom .navbar-nav .nav-link:focus,
        .navbar-custom .navbar-nav .nav-link:hover {
            color: #F3C623;
        }

        /* Toggle button color (hamburger) */
        .navbar-custom .navbar-toggler {
            border-color: #f8f9fa;
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23f8f9fa' viewBox='0 0 30 30'%3e%3cpath stroke='%23f8f9fa' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
    </style>
</head>

<body>

    <?php include "includes/navbar.php" ?>

    <main style="margin-top: 5rem;">
        <div class="container">
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
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>