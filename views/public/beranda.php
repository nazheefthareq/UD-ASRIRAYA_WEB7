<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD Asri Raya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        #hero {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        #hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
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
        <section id="hero">
            <div class="container">
                <h1>UD ASRI RAYA</h1>
                <p class="lead">Selamat Datang di Website UD Asri Raya. <br>
                    Kami memberikan pelayanan dan solusi terbaik untuk segala kebutuhan bangunan Anda.</p>
            </div>
        </section>

        <section id="about" class="py-5">
            <div class="container">
                <h2 class="mb-4">Tentang Kami</h2>
                <p>UD ASRI RAYA adalah toko dan perusahaan yang bergerak di bidang penyediaan alat dan bahan bangunan,
                    yang telah dipercaya oleh berbagai pelanggan mulai dari individu hingga kontraktor profesional.
                    Kami berkomitmen untuk menyediakan produk berkualitas tinggi dengan harga yang kompetitif, serta layanan yang
                    ramah dan terpercaya. Dengan pengalaman dan dedikasi kami di industri ini, UD ASRI RAYA hadir sebagai mitra
                    terbaik Anda dalam mewujudkan pembangunan yang kuat, aman, dan estetik.</p>
            </div>
        </section>

        <section id="lokasi" class="py-5 bg-light">
            <div class="container">
                <h2 class="mb-4">Lokasi</h2>
                <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d294.182670022656!2d112.71284101353615!3d-7.236911174854169!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zN8KwMTQnMTIuOSJTIDExMsKwNDInNDYuNSJF!5e0!3m2!1sen!2sid!4v1749308983097!5m2!1sen!2sid"
                    width="300" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                <p>Jl. Tambak Asri No.174, Morokrembangan, Kec. Krembangan, Kota SBY, Jawa Timur 60178, Indonesia, Kota Surabaya.</p>
            </div>
        </section>

        <section id="kontak" class="py-5">
            <div class="container">
                <h2 class="mb-4">Hubungi Kami</h2>
                <!-- Tambahkan form kontak atau informasi kontak di sini jika diperlukan -->
                <p>Silakan hubungi kami untuk informasi lebih lanjut.</p>
            </div>
        </section>
    </main>

    <footer>
        <div class="container">
            &copy; Copyright UD Asri Raya 2025
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>