<?php
function getAllProduk($conn) {
    return $conn->query("SELECT * FROM stok_produk");
}

function getProdukById($conn, $id) {
    return $conn->query("SELECT * FROM stok_produk WHERE id_produk = '$id'")->fetch_assoc();
}

function kurangiStok($conn, $id, $jumlah) {
    return $conn->query("UPDATE stok_produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id'");
}

function simpanTransaksi($conn, $id, $jumlah, $harga, $tanggal, $total) {
    return $conn->query("INSERT INTO transaksi_kasir (id_produk, jumlah_produk, harga_satuan, tanggal_transaksi, total_harga)
                         VALUES ('$id', '$jumlah', '$harga', '$tanggal', '$total')");
}
?>
