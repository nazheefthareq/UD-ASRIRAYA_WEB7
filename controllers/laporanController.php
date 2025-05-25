<?php
require_once __DIR__ . '/../models/laporan.php';

$laporanModel = new Laporan();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Tambah data laporan
    if (isset($_POST['tambah'])) {
        $tanggal = $_POST['tanggal'];
        $jenis = $_POST['jenis'];
        $deskripsi = $_POST['deskripsi'];
        $nominal = $_POST['nominal'];

        // Validasi sederhana
        if ($tanggal && $jenis && $deskripsi && $nominal) {
            $conn = connectDB();
            $stmt = $conn->prepare("INSERT INTO laporan_keuangan (tanggal, jenis, deskripsi, nominal) VALUES (?, ?, ?, ?)");
            $stmt->execute([$tanggal, $jenis, $deskripsi, $nominal]);
            header("Location: ../views/admin/laporan_keuangan/laporan_keuangan.php");
            exit();
        }
    }

    // Filter berdasarkan tanggal
    if (isset($_POST['filter'])) {
        $dari = $_POST['dari'];
        $sampai = $_POST['sampai'];
        $data = $laporanModel->getLaporanByTanggal($dari, $sampai);
        include '../views/admin/laporan_keuangan/laporan_keuangan.php';
        exit();
    }
}

// Default: ambil semua data
$data = $laporanModel->getAllLaporan();
include '../views/admin/laporan_keuangan/laporan_keuangan.php';
