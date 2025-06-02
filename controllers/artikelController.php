<?php
require_once __DIR__ . '/../models/artikel.php';

class ArtikelController
{
    private $model;

    public function __construct()
    {
        $this->model = new Artikel();
    }

    public function index()
    {
        $artikelList = $this->model->getAllArtikel(); 
        require __DIR__ . '/../views/public/list_artikel.php';
    }

    public function show($id)
    {
        $data = $this->model->getArtikelById($id);
        if (!$data) {
            echo "Artikel tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/public/detail_artikel.php';
    }

    public function create()
    {
        require __DIR__ . '/../views/admin/manajemen_artikel_create.php';
    }

    public function store()
    {
        $judul   = trim($_POST['judul_artikel'] ?? '');
        $isi     = trim($_POST['isi_artikel'] ?? '');
        if (empty($judul) || empty($isi)) {
            echo "Judul dan isi artikel wajib diisi.";
            exit;
        }

        $gambar  = $_FILES['gambar']['name'] ?? '';
        $tanggal_publish = date('Y-m-d H:i:s');

        if ($gambar && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = __DIR__ . '/../assets/img/';
            $ext = pathinfo($gambar, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $ext;
            $target_file = $target_dir . $newFileName;

            $allowedTypes = ['jpg','jpeg','png','gif'];
            if (!in_array(strtolower($ext), $allowedTypes)) {
                echo "Tipe file tidak diizinkan.";
                exit;
            }

            if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                echo "Gagal mengunggah gambar.";
                exit;
            }

            $gambar = $newFileName;
        } else {
            $gambar = ''; 
        }

        $success = $this->model->tambahArtikel($judul, $isi, $gambar, $tanggal_publish);

        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
            exit;
        } else {
            echo "Gagal menambah artikel";
        }
    }

    public function edit($id)
    {
        $data = $this->model->getArtikelById($id);
        if (!$data) {
            echo "Artikel tidak ditemukan";
            exit;
        }
        require __DIR__ . '/../views/admin/manajemen_artikel_edit.php';
    }

    public function update($id)
    {
        $judul   = trim($_POST['judul_artikel'] ?? '');
        $isi     = trim($_POST['isi_artikel'] ?? '');
        if (empty($judul) || empty($isi)) {
            echo "Judul dan isi artikel wajib diisi.";
            exit;
        }

        $gambar  = $_FILES['gambar']['name'] ?? '';
        $tanggal_publish = date('Y-m-d H:i:s');

        if ($gambar && $_FILES['gambar']['error'] === UPLOAD_ERR_OK) {
            $target_dir = __DIR__ . '/../assets/img/';
            $ext = pathinfo($gambar, PATHINFO_EXTENSION);
            $newFileName = uniqid() . '.' . $ext;
            $target_file = $target_dir . $newFileName;

            $allowedTypes = ['jpg','jpeg','png','gif'];
            if (!in_array(strtolower($ext), $allowedTypes)) {
                echo "Tipe file tidak diizinkan.";
                exit;
            }

            if (!move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                echo "Gagal mengunggah gambar.";
                exit;
            }

            $gambar = $newFileName;
        } else {
            $gambar = $_POST['gambar_lama'] ?? '';
        }

        $success = $this->model->editArtikel($id, $judul, $isi, $gambar, $tanggal_publish);

        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
            exit;
        } else {
            echo "Gagal mengupdate artikel";
        }
    }

    public function delete($id)
    {
        $success = $this->model->hapusArtikel($id);
        if ($success) {
            header("Location: admin.php?page=manajemen_artikel");
            exit;
        } else {
            echo "Gagal menghapus artikel";
        }
    }
}
