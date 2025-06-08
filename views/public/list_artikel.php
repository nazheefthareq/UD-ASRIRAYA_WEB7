<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Daftar Artikel - UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        html,
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8f9fa;
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }


        h1 {
            font-weight: 700;
            color: #10375C;
        }

        footer {
            background-color: #10375C;
            color: #F3C623;
            padding: 20px 0;
            text-align: center;
        }

        main {
            flex: 1;
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

        .card-title {
            color: #10375C;
        }

        .btn-detail {
            background-color: #10375C;
            color: #F3C623;
            border: none;
        }

        .btn-detail:hover {
            background-color: #0b2c47;
            color: #ffc107;
        }
    </style>
</head>

<body>

    <?php include "includes/navbar.php" ?>

    <main class="container" style="margin-top: 10rem;">
        <h1 class="mb-4">Daftar Artikel</h1>
        <div class="row g-4">
            <!-- LOOP PAKE PHP WIL BUAT BAGIAN YANG INI NANTI -->
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <!-- AMBEK BAGIAN NGISOR IKI GAE GAMBAR, NGKO GAE OPO ENGGAK E SEMBARANGMU, LEK GAPAKE DIHAPUS AE -->
                    <!-- <img src="https://via.placeholder.com/600x400" class="card-img-top" alt="Thumbnail Artikel"> -->
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Judul Artikel 1</h5>
                        <p class="card-text">Ini adalah deskripsi singkat artikel yang akan ditampilkan pada daftar artikel.</p>
                        <div class="mt-auto">
                            <a href="detail_artikel.php" class="btn btn-detail w-100">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>

    <?php include "includes/footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>