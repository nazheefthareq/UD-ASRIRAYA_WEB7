<?php
require_once __DIR__ . '/../models/laporan.php';

$laporanModel = new Laporan();

// Jika tombol filter diklik
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['filter'])) {
    $dari = $_GET['dari'] ?? '';
    $sampai = $_GET['sampai'] ?? '';
    
    // Redirect ke view dengan query string
    header("Location: ../views/admin/laporan/laporan_pemasukan.php?filter=1&dari=$dari&sampai=$sampai");
    exit;
}

// Jika tidak ada filter, tampilkan semua data
header("Location: ../views/admin/laporan/laporan_pemasukan.php");
exit;