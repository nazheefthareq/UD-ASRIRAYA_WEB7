<?php
    require_once __DIR__ . '/../../../controllers/authController.php'; 
    require_once __DIR__ . '/../../../config/database.php';
    require_once __DIR__ . '/../../../models/produk.php';
    $conn = connectDB();
    $produkModel = new Produk();

    $query = $conn->query("SELECT id_kategori, nama_kategori FROM kategori_produk");
    $kategorilist = $query->fetchAll(PDO::FETCH_ASSOC);

    if (isset($_GET['id'])) {
        $produk = $produkModel->getProdukID($_GET['id']);
    } else {
        header("Location: manajemen_stok.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap');
        body {
            background-color: #10375C;
            font-family: Plus Jakarta Sans;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="bg-white rounded-4 shadow p-5" style="width: 100%; max-width: 700px;">
            <h3 class="fw-bold mb-4">Edit Barang</h3>
            <form action="../../../controllers/stokController.php" method="POST">
                <input type="hidden" name="id" value="<?= $produk['id_produk'] ?>">
                <div class="mb-3">
                    <label for="namaBarang" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="namaBarang" placeholder="Semen Gresik" value="<?= $produk['nama_produk']?>">
                </div>

                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="kategori" class="form-label">Kategori</label>
                        <select class="form-select" name="kategori">
                            <?php foreach($kategorilist as $kategori): ?>
                                <option value="<?php echo $kategori['id_kategori']?>"
                                    <?= $kategori['id_kategori'] == $produk['id_kategori'] ? 'Selected' : '' ?>>
                                    <?= $kategori['nama_kategori'] ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" name="satuan" placeholder="Sak" value="<?= $produk['satuan']?>">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="hargaJual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control" name="hargaJual" placeholder="35.000" value="<?= $produk['harga_jual'] ?>">
                    </div>
                </div>

                <div class="row g-3 mt-2">
                    <div class="col-md-6">
                        <label for="jumlahStok" class="form-label">Jumlah Stok</label>
                        <input type="number" class="form-control" name="jumlahStok" placeholder="200" value="<?= $produk['stok_produk'] ?>">
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-3 mt-4">
                    <a href="manajemen_stok.php" class="btn btn-danger px-4">Batal</a>
                    <button type="submit" class="btn btn-success px-4" name="update">Simpan</button>
                </div>
            </form>
        </div>
    </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
