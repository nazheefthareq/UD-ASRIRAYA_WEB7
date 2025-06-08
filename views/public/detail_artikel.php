<?php
    require_once __DIR__ . '/../../models/artikel.php';

    $artikelmodel = new Artikel();

    if (isset($_GET['id'])) {
        $artikellist = $artikelmodel->getArtikelById($_GET['id']);
    } else {
        header("Location: list_artikel.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Artikel - UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
            background-color: #f8f9fa;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        main {
            flex: 1;
        }


        footer {
            background-color: #10375C;
            color: #F3C623;
            padding: 20px 0;
            text-align: center;
        }

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

        .navbar-custom .navbar-toggler {
            border-color: #f8f9fa;
        }

        .navbar-custom .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23f8f9fa' viewBox='0 0 30 30'%3e%3cpath stroke='%23f8f9fa' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .artikel-title {
            color: #10375C;
            font-weight: 700;
        }

        .artikel-content {
            text-align: justify;
        }
    </style>
</head>

<body>

    <?php include "includes/navbar.php" ?>

    <main class="container" style="margin-top: 10rem;">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <!-- Thumbnail Artikel -->
                <img src="../../uploads/<?= $artikellist['gambar']?>" alt="Thumbnail Artikel" class="img-fluid rounded mb-4 shadow-sm">

                <!-- Judul Artikel -->
                <h1 class="artikel-title mb-3"><?= $artikellist['judul_artikel']?></h1>

                <!-- Tanggal dan Penulis -->
                <div class="mb-3 text-muted">
                    <small>
                        <i class="bi bi-calendar-event"></i> <?= $artikellist['tanggal_publish']?>
                        &nbsp;|&nbsp;
                        <i class="bi bi-person"></i> Admin
                    </small>
                </div>

                <!-- Konten Artikel -->
                <div class="artikel-content">
                    <?= $artikellist['isi_artikel'] ?>
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-4">
                    <a href="list_artikel.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar Artikel
                    </a>
                </div>
            </div>
        </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>