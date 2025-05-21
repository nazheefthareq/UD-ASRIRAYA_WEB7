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
        $result = $this->conn->query($sql);

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function getArtikelById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM artikel WHERE id_artikel = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function tambahArtikel($judul, $isi, $gambar, $tanggal_publish)
    {
        $stmt = $this->conn->prepare("INSERT INTO artikel (judul_artikel, isi_artikel, gambar, tanggal_publish) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $judul, $isi, $gambar, $tanggal_publish);
        return $stmt->execute();
    }

    public function editArtikel($id, $judul, $isi, $gambar, $tanggal_publish)
    {
        $stmt = $this->conn->prepare("UPDATE artikel SET judul_artikel=?, isi_artikel=?, gambar=?, tanggal_publish=? WHERE id_artikel=?");
        $stmt->bind_param("ssssi", $judul, $isi, $gambar, $tanggal_publish, $id);
        return $stmt->execute();
    }

    public function hapusArtikel($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM artikel WHERE id_artikel=?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
?>
