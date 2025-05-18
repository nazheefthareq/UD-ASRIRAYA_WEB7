<?php
    // fungsi untuk koneksi ke database
    function connectDB() {
        $host = 'localhost';
        $dbname = 'db_asriraya';
        $username = 'root';
        $password = '';

        // error handling menggunakan PDO
        try {
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $error) {
            die("Koneksi Database Gagal: ".$error->getMessage());
        }
    }
?>