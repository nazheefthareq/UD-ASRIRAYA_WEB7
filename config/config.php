<?php
// Set zona waktu default
date_default_timezone_set('Asia/Jakarta');

// Base URL — ubah sesuai server
define('BASE_URL', 'http://localhost/UD-ASRIRAYA_WEB7/');

// Nama Website
define('SITE_NAME', 'UD Asri Raya');

// Mode debug (menampilkan error saat pengembangan)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Panggil koneksi database
require_once __DIR__ . '/database.php';
