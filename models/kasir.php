<?php 
    require_once __DIR__ . '/../config/database.php';

    class Kasir {
        private $conn;
        
        public function __construct(){
            $conn = connectDB();
            $this->conn = $conn;
        }

        public function simpanTransaksi($id_produk, $jumlah, $harga, $total) {
            $stmt = $this->conn->prepare("INSERT INTO transaksi_kasir (id_produk, jumlah_produk, harga_satuan, tanggal_transaksi, total_harga) VALUES (?, ?, ?, CURDATE(), ?)");
            return $stmt->execute([$id_produk, $jumlah, $harga, $total]);
        }
    }

?>