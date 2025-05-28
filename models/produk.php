<?php
    require_once __DIR__ . '/../config/database.php';

    class Produk {
        private $conn;

        public function __construct(){
            $conn = connectDB();
            $this->conn = $conn;
        }

        public function getAllProduk($keyword = null){
            $sql = "SELECT sp.id_produk,kp.nama_kategori, sp.nama_produk, sp.satuan, sp.harga_beli, sp.harga_jual, sp.stok_produk FROM stok_produk sp JOIN kategori_produk kp ON sp.id_kategori = kp.id_kategori";
            if ($keyword) {
                $sql .= " WHERE sp.nama_produk LIKE :keyword OR kp.nama_kategori LIKE :keyword";
                $stmt = $this->conn->prepare($sql);
                $keyword = "%" . $keyword . "%";
                $stmt->bindParam(":keyword", $keyword);
                $stmt->execute();
                return $stmt;
            } else {
                return $this->conn->query($sql);
            }
        }

        public function getProdukID($id){
            $query = $this->conn->prepare("SELECT * FROM stok_produk WHERE id_produk = :id");
            $query->bindParam(":id",$id);
            $query->execute();
            return $query->fetch(PDO::FETCH_ASSOC);
        }

        public function tambahProduk($kategori, $nama, $satuan, $harga_beli, $harga_jual, $stok, $datetime){
            $query = $this->conn->prepare("INSERT INTO stok_produk (id_kategori, nama_produk, satuan, harga_beli, harga_jual, stok_produk, created_at) VALUES (:kategori, :nama, :satuan, :hargabeli, :hargajual, :stok, :tanggal)");
            $query->bindParam(":kategori", $kategori);
            $query->bindParam(":nama", $nama);
            $query->bindParam(":satuan", $satuan);
            $query->bindParam(":hargabeli",$harga_beli);
            $query->bindParam(":hargajual",$harga_jual);
            $query->bindParam(":stok",$stok);
            $query->bindParam(":tanggal",$datetime);
            return $query->execute();
        }

        public function updateProduk($id, $kategori, $nama, $satuan, $harga_beli, $harga_jual, $stok, $datetime){
            $query = $this->conn->prepare("UPDATE stok_produk SET id_kategori = :kategori, nama_produk = :nama, satuan = :satuan, harga_beli = :hargabeli, harga_jual = :hargajual, stok_produk = :stok, created_at = :tanggal WHERE id_produk = :id");
            $query->bindParam(":id", $id);
            $query->bindParam(":kategori",$kategori);
            $query->bindParam(":nama", $nama);
            $query->bindParam(":satuan", $satuan);
            $query->bindParam(":hargabeli",$harga_beli);
            $query->bindParam(":hargajual",$harga_jual);
            $query->bindParam(":stok",$stok);
            $query->bindParam(":tanggal",$datetime);
            return $query->execute();
        }

        public function hapusProduk($id){
            $query = $this->conn->prepare("DELETE FROM stok_produk WHERE id_produk = :id");
            $query->bindParam(":id",$id);
            return $query->execute();
        }

        public function countProduk(){
            $query = $this->conn->query("SELECT COUNT(*) AS total FROM stok_produk");
            $result = $query->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        }

        public function getProdukStokTerbanyak() {
            $sql = "SELECT * FROM stok_produk ORDER BY stok_produk DESC LIMIT 1";
            $stmt = $this->conn->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function getProdukStokTersedikit() {
            $sql = "SELECT * FROM stok_produk ORDER BY stok_produk ASC LIMIT 1";
            $stmt = $this->conn->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>