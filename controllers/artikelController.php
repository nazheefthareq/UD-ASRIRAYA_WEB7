<?php
require_once __DIR__ . '/../models/artikel.php';

class ArtikelController
{
    private $model;

    public function __construct()
    {
        $this->model = new Artikel();
    }

    // Semua artikel 
    public function index()
    {
        $artikel = $this->model->getAllArtikel();
        // View daftar artikel 
        require __DIR__ . '/../views/public/list_artikel.php';
    }

    // Detail artikel berdasarkan id
    public function show($id)
    {
        $data = $this->model->getArtikelById($id);
        if (!$data) {
            echo "Artikel tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/public/detail_artikel.php';
    }

    // FORM tambah artikel (admin)
    public function create()
    {
        require __DIR__ . '/../views/admin/manajemen_artikel_create.php';
    }

    // Simpan artikel baru (admin)
    public function store()
    {
        $judul   = $_POST['judul_artikel'] ?? '';
        $isi     = $_POST['isi_artikel'] ?? '';
        $gambar  = $_FILES['gambar']['name'] ?? '';
        $tanggal_publish = date('Y-m-d H:i:s');

        // Upload gambar
        if ($gambar) {
            $target_dir = __DIR__ . '/../assets/img/';
            $target_file = $target_dir . basename($gambar);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        }

        $success = $this->model->tambahArtikel($judul, $isi, $gambar, $tanggal_publish);

        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
        } else {
            echo "Gagal menambah artikel";
        }
    }

    // FORM edit artikel (admin)
    public function edit($id)
    {
        $data = $this->model->getArtikelById($id);
        if (!$data) {
            echo "Artikel tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/admin/manajemen_artikel_edit.php';
    }

    // Update artikel (admin)
    public function update($id)
    {
        $judul   = $_POST['judul_artikel'] ?? '';
        $isi     = $_POST['isi_artikel'] ?? '';
        $gambar  = $_FILES['gambar']['name'] ?? '';
        $tanggal_publish = date('Y-m-d H:i:s');

        if ($gambar) {
            $target_dir = __DIR__ . '/../assets/img/';
            $target_file = $target_dir . basename($gambar);
            move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file);
        } else {
            $gambar = $_POST['gambar_lama'] ?? '';
        }

        $success = $this->model->editArtikel($id, $judul, $isi, $gambar, $tanggal_publish);

        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
        } else {
            echo "Gagal mengupdate artikel";
        }
    }

    // Hapus artikel (admin)
    public function delete($id)
    {
        $success = $this->model->hapusArtikel($id);
        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
        } else {
            echo "Gagal menghapus artikel";
        }
    }
}
