<?php
session_start();
$conn = new mysqli("localhost", "root", "", "db_asriraya");

// Tambah ke keranjang
if (isset($_POST['tambah_keranjang'])) {
    $id = $_POST['id_produk'];
    $jumlah = intval($_POST['jumlah']);
    $produk = $conn->query("SELECT * FROM stok_produk WHERE id_produk = '$id'")->fetch_assoc();

    if ($jumlah > 0 && $jumlah <= $produk['stok_produk']) {
        $_SESSION['keranjang'][$id] = ($_SESSION['keranjang'][$id] ?? 0) + $jumlah;
    }
}

// Ubah jumlah
if (isset($_POST['ubah_jumlah'])) {
    $id = $_POST['id_produk'];
    $jumlah = intval($_POST['jumlah']);
    if ($jumlah > 0) {
        $_SESSION['keranjang'][$id] = $jumlah;
    }
}

// Hapus item
if (isset($_POST['hapus_item'])) {
    $id = $_POST['id_produk'];
    unset($_SESSION['keranjang'][$id]);
}

// Checkout
if (isset($_POST['checkout'])) {
    $tanggal = date('Y-m-d');
    foreach ($_SESSION['keranjang'] as $id => $jumlah) {
        $produk = $conn->query("SELECT * FROM stok_produk WHERE id_produk = '$id'")->fetch_assoc();
        $harga = $produk['harga_jual'];
        $total = $harga * $jumlah;

        $conn->query("INSERT INTO transaksi_kasir (id_produk, jumlah_produk, harga_satuan, tanggal_transaksi, total_harga) VALUES ('$id', '$jumlah', '$harga', '$tanggal', '$total')");
        $conn->query("UPDATE stok_produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id'");
    }
    unset($_SESSION['keranjang']);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kasir - Asri Raya</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            display: flex;
            background-color: #f4f6f9;
        }
        .sidebar {
            width: 250px;
            background-color: #0f3359;
            height: 100vh;
            color: #fff;
            display: flex;
            flex-direction: column;
            padding: 20px;
        }
        .brand {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .brand .logo {
            background-color: #f0c419;
            color: #1f2d3d;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-right: 10px;
        }
        .brand-name {
            font-weight: bold;
            color: #f0c419;
        }
        .nav-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .nav-links li {
            display: flex;
            align-items: center;
            padding: 12px 10px;
            cursor: pointer;
            color: #fff;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .nav-links li .icon {
            margin-right: 10px;
        }
        .nav-links li:hover,
        .nav-links li.active {
            background-color: rgba(255, 255, 255, 0.1);
            color: #f0c419;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
        }
        .produk-card {
            display: inline-block;
            width: 200px;
            background: white;
            border-radius: 10px;
            margin: 10px;
            padding: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            vertical-align: top;
        }
        .produk-card img {
            width: 100%;
            height: 120px;
            object-fit: contain;
            background-color: #f1f5f9;
            border-radius: 8px;
        }
        .produk-card h4 {
            margin: 10px 0 0;
        }
        .produk-card p {
            margin: 5px 0;
        }
        .keranjang {
            margin-top: 20px;
            background: #fff;
            padding: 15px;
            border-radius: 8px;
        }
        .btn {
            padding: 6px 12px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-small {
            padding: 4px 8px;
        }
        input[type=number] {
            width: 50px;
        }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar">
    <div class="brand">
        <div class="logo">AR</div>
        <div class="brand-name">Asri Raya Admin</div>
    </div>
    <ul class="nav-links">
        <li><i class="icon">◼️</i> Dashboard</li>
        <li class="active"><i class="icon">🚖</i> Kasir</li>
        <li><i class="icon">📦</i> Stok Barang</li>
        <li><i class="icon">💰</i> Laporan Keuangan</li>
        <li><i class="icon">📄</i> Manajemen Artikel</li>
    </ul>
</div>

<div class="main-content">
    <h2>Kasir</h2>
    <div>
        <?php
        $produk = $conn->query("SELECT * FROM stok_produk");
        while ($p = $produk->fetch_assoc()) {
        ?>
            <div class="produk-card">
                <img src="https://cdn-icons-png.flaticon.com/512/1046/1046750.png" alt="Produk">
                <h4><?= $p['nama_produk'] ?></h4>
                <p><strong>Rp <?= number_format($p['harga_jual']) ?></strong></p>
                <p>Stok: <?= $p['stok_produk'] ?></p>
                <form method="post">
                    <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                    <input type="number" name="jumlah" min="1" value="1">
                    <button type="submit" name="tambah_keranjang" class="btn">Tambah</button>
                </form>
            </div>
        <?php } ?>
    </div>

    <div class="keranjang">
        <h3>Keranjang</h3>
        <table>
            <tr><th>Produk</th><th>Jumlah</th><th>Harga</th><th>Total</th><th>Aksi</th></tr>
            <?php
            $grand_total = 0;
            if (!empty($_SESSION['keranjang'])) {
                foreach ($_SESSION['keranjang'] as $id => $jumlah) {
                    $p = $conn->query("SELECT * FROM stok_produk WHERE id_produk = '$id'")->fetch_assoc();
                    $total = $jumlah * $p['harga_jual'];
                    $grand_total += $total;
                    echo "<tr>
                        <td>{$p['nama_produk']}</td>
                        <td>
                            <form method='post' style='display:inline-block'>
                                <input type='hidden' name='id_produk' value='$id'>
                                <input type='number' name='jumlah' value='$jumlah'>
                                <button name='ubah_jumlah' class='btn btn-small'>Ubah</button>
                            </form>
                        </td>
                        <td>Rp ".number_format($p['harga_jual'])."</td>
                        <td>Rp ".number_format($total)."</td>
                        <td>
                            <form method='post' style='display:inline-block'>
                                <input type='hidden' name='id_produk' value='$id'>
                                <button name='hapus_item' class='btn btn-danger btn-small'>Hapus</button>
                            </form>
                        </td>
                    </tr>";
                }
            }
            ?>
            <tr><td colspan="3"><strong>Total</strong></td><td><strong>Rp <?= number_format($grand_total) ?></strong></td><td></td></tr>
        </table>
        <form method="post">
            <button name="checkout" class="btn">Checkout</button>
        </form>
    </div>
</div>

</body>
</html>
