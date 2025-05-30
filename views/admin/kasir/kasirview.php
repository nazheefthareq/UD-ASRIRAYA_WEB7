<?php
$produk = getAllProduk($conn);
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
            position: fixed;
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
            margin-left: 300px;
            padding: 20px;
            width: calc(100% - 300px);
        }
        .content-wrapper {
            display: flex;
            gap: 20px;
            align-items: flex-start;
        }
        .produk-section {
            flex: 1.2;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow-y: auto;
            max-height: 100%;
        }
        .produk-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        .produk-card {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 15px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border: 1px solid #e9ecef;
        }
        .produk-card h4 {
            font-size: 18px;
            margin: 0 0 10px 0;
            color: #2c3e50;
        }
        .produk-card p {
            margin: 5px 0;
            color: #6c757d;
        }
        .produk-card .harga {
            font-weight: bold;
            color: #28a745;
            font-size: 16px;
        }
        .keranjang-section {
            flex: 0.8;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            max-height: 100%;
            overflow-y: auto;
            position: sticky;
            top: 0;
        }
        .keranjang table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .keranjang th, .keranjang td {
            padding: 8px;
            text-align: left;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-size: 14px;
        }
        .keranjang th {
            background-color: #f8f9fa;
            font-weight: 600;
        }
        .btn {
            padding: 6px 12px;
            background: #10b981;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }
        .btn:hover {
            background: #059669;
        }
        .btn-danger {
            background: #ef4444;
        }
        .btn-danger:hover {
            background: #dc2626;
        }
        .btn-small {
            padding: 4px 8px;
            font-size: 12px;
        }
        .btn-checkout {
            width: 100%;
            padding: 12px;
            font-size: 16px;
            font-weight: bold;
            background: #0f3359;
        }
        .btn-checkout:hover {
            background: #1e40af;
        }
        input[type=number] {
            width: 60px;
            padding: 4px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .total-section {
            border-top: 2px solid #0f3359;
            padding-top: 15px;
            margin-top: 15px;
        }
        .grand-total {
            font-size: 18px;
            font-weight: bold;
            color: #0f3359;
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
    <div class="content-wrapper">
        <!-- Bagian Produk -->
        <div class="produk-section">
            <h3>Daftar Produk</h3>
            <div class="produk-grid">
                <?php while ($p = $produk->fetch_assoc()) { ?>
                    <div class="produk-card">
                        <h4><?= $p['nama_produk'] ?></h4>
                        <p class="harga">Rp <?= number_format($p['harga_jual']) ?></p>
                        <p>Stok: <?= $p['stok_produk'] ?></p>
                        <form method="post">
                            <input type="hidden" name="id_produk" value="<?= $p['id_produk'] ?>">
                            <div style="display: flex; gap: 5px; align-items: center; margin-top: 10px;">
                                <input type="number" name="jumlah" min="1" value="1">
                                <button type="submit" name="tambah_keranjang" class="btn">Tambah</button>
                            </div>
                        </form>
                    </div>
                <?php } ?>
            </div>
        </div>

        <!-- Bagian Keranjang -->
        <div class="keranjang-section">
            <h3>Keranjang Belanja</h3>
            <div class="keranjang">
                <table>
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $grand_total = 0;
                        if (!empty($_SESSION['keranjang'])) {
                            foreach ($_SESSION['keranjang'] as $id => $jumlah) {
                                $p = getProdukById($conn, $id);
                                $total = $jumlah * $p['harga_jual'];
                                $grand_total += $total;
                                echo "<tr>
                                    <td style='font-weight: 500;'>{$p['nama_produk']}</td>
                                    <td>
                                        <form method='post' style='display:inline-block'>
                                            <input type='hidden' name='id_produk' value='$id'>
                                            <input type='number' name='jumlah' value='$jumlah' min='1'>
                                            <button name='ubah_jumlah' class='btn btn-small'>✓</button>
                                        </form>
                                    </td>
                                    <td>Rp ".number_format($p['harga_jual'])."</td>
                                    <td style='font-weight: 600;'>Rp ".number_format($total)."</td>
                                    <td>
                                        <form method='post' style='display:inline-block'>
                                            <input type='hidden' name='id_produk' value='$id'>
                                            <button name='hapus_item' class='btn btn-danger btn-small'>×</button>
                                        </form>
                                    </td>
                                </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' style='text-align: center; color: #6c757d; padding: 20px;'>Keranjang kosong</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
                
                <div class="total-section">
                    <div class="grand-total">
                        Total: Rp <?= number_format($grand_total) ?>
                    </div>
                    <form method="post" style="margin-top: 15px;">
                        <button name="checkout" class="btn btn-checkout" <?= $grand_total == 0 ? 'disabled' : '' ?>>
                            Checkout (Rp <?= number_format($grand_total) ?>)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>