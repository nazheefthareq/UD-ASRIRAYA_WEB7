<?php
require_once __DIR__ . '/../models/artikel.php';

$artikelModel = new Artikel();

// Tambah Artikel
if (isset($_POST['tambah'])) {
    $judul = $_POST['judul_artikel'];
    $isi = $_POST['isi_artikel'];
    $tanggal = $_POST['tanggal_publish'];
    $gambar = null;

    // Proses upload gambar
    if (!empty($_FILES['gambar']['name'])) {
        $targetDir = "../uploads/";
        $filename = basename($_FILES["gambar"]["name"]);
        $targetFile = $targetDir . time() . "_" . $filename;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                $gambar = basename($targetFile);
            }
        }
    }

    $artikelModel->tambahArtikel($judul, $isi, $gambar, $tanggal);
    header("Location: ../views/admin/artikel/manajemen_artikel.php");
    exit;
}

// Hapus Artikel
if (isset($_POST['hapus'])) {
    $id = $_POST['id'];
    $artikelModel->hapusArtikel($id);
    header("Location: ../views/admin/artikel/manajemen_artikel.php");
    exit;
}

// Update Artikel
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $judul = $_POST['judul_artikel'];
    $isi = $_POST['isi_artikel'];
    $tanggal = $_POST['tanggal_publish'];
    $gambar = $_POST['gambar_lama'];

    // Jika user upload gambar baru
    if (!empty($_FILES['gambar']['name'])) {
        $targetDir = "../uploads/";
        $filename = basename($_FILES["gambar"]["name"]);
        $targetFile = $targetDir . time() . "_" . $filename;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
            if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFile)) {
                $gambar = basename($targetFile);
            }
        }
    }

    $artikelModel->updateArtikel($id, $judul, $isi, $gambar, $tanggal);
    header("Location: ../views/admin/artikel/manajemen_artikel.php");
    exit;
}
