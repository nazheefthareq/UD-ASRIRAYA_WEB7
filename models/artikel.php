<?php
require_once __DIR__ . '/../config/database.php';

class Artikel
{
    private $conn;

    public function __construct()
    {
        $this->conn = connectDB(); 
    }

    public function getAllArtikel()
    {
        $sql = "SELECT * FROM artikel ORDER BY tanggal_publish DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArtikelById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahArtikel($judul, $isi, $gambar, $tanggal_publish)
    {
        $stmt = $this->conn->prepare("INSERT INTO artikel (judul_artikel, isi_artikel, gambar, tanggal_publish) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$judul, $isi, $gambar, $tanggal_publish]);
    }

    public function editArtikel($id, $judul, $isi, $gambar, $tanggal_publish)
    {
        $stmt = $this->conn->prepare("UPDATE artikel SET judul_artikel=?, isi_artikel=?, gambar=?, tanggal_publish=? WHERE id_artikel=?");
        return $stmt->execute([$judul, $isi, $gambar, $tanggal_publish, $id]);
    }

    public function hapusArtikel($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM artikel WHERE id_artikel=?");
        return $stmt->execute([$id]);
    }
}
?>
