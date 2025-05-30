<?php
require_once __DIR__ . '/../config/database.php';

class Laporan {
    private $conn;

    public function __construct() {
        $conn = connectDB();
        $this->conn = $conn;
    }

    public function getAllLaporan() {
        $sql = "SELECT * FROM transaksi_kasir ORDER BY tanggal_transaksi DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLaporanByTanggal($dari, $sampai) {
        $sql = "SELECT * FROM transaksi_kasir 
                WHERE tanggal_transaksi BETWEEN :dari AND :sampai
                ORDER BY tanggal_transaksi DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dari', $dari);
        $stmt->bindParam(':sampai', $sampai);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalPemasukan() {
        $sql = "SELECT SUM(total_harga) AS total FROM transaksi_kasir";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
    
}

?>