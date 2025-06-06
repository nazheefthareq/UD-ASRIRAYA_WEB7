<?php
require_once __DIR__ . '/../config/database.php';

class Laporan
{
    private $conn;

    public function __construct()
    {
        $conn = connectDB();
        $this->conn = $conn;
    }

    public function getAllLaporan()
    {
        $sql = "SELECT sp.nama_produk, tk.jumlah_produk , tk.harga_satuan , tk.tanggal_transaksi, tk.total_harga FROM transaksi_kasir tk JOIN stok_produk sp ON tk.id_produk = sp.id_produk ORDER BY tk.tanggal_transaksi DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLaporanByTanggal($dari, $sampai)
    {
        $sql = "SELECT sp.nama_produk, tk.jumlah_produk , tk.harga_satuan , tk.tanggal_transaksi, tk.total_harga 
                FROM transaksi_kasir tk 
                JOIN stok_produk sp ON tk.id_produk = sp.id_produk 
                WHERE tk.tanggal_transaksi BETWEEN :dari AND :sampai
                ORDER BY tk.tanggal_transaksi DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dari', $dari);
        $stmt->bindParam(':sampai', $sampai);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPemasukan()
    {
        $sql = "SELECT SUM(total_harga) AS total FROM transaksi_kasir";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getTotalPenjualanHariIni()
    {
        $sql = "SELECT SUM(total_harga) AS total 
                FROM transaksi_kasir 
                WHERE DATE(tanggal_transaksi) = CURDATE()";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function getlimalaporan()
    {
        $sql = "SELECT sp.nama_produk, tk.jumlah_produk , tk.harga_satuan , tk.tanggal_transaksi, tk.total_harga FROM transaksi_kasir tk JOIN stok_produk sp ON tk.id_produk = sp.id_produk ORDER BY tk.tanggal_transaksi DESC LIMIT 5";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
