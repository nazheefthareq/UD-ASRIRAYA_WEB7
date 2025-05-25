<?php
require_once __DIR__ . '/../config/database.php';

class Laporan {
    private $conn;

    public function __construct() {
        $conn = connectDB();
        $this->conn = $conn;
    }

    public function getAllLaporan() {
        $sql = "SELECT * FROM laporan_keuangan ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLaporanByTanggal($dari, $sampai) {
        $sql = "SELECT * FROM laporan_keuangan 
                WHERE tanggal BETWEEN :dari AND :sampai
                ORDER BY tanggal DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':dari', $dari);
        $stmt->bindParam(':sampai', $sampai);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    
}

?>