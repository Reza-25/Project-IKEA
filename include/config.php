<?php
// At the top of config.php
ini_set('display_errors', 0); // Turn off for production
error_reporting(E_ALL);
ob_start(); // Tangkap semua output

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include/config.php

// Cek apakah sudah diakses via HTTPS atau HTTP
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

// Dapatkan nama domain dan path folder
$domain = $_SERVER['HTTP_HOST'];
$path = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/\\');

// Definisikan BASE_URL
define('BASE_URL', $protocol . $domain . $path);

// Definisikan BASE_PATH
define('BASE_PATH', realpath(__DIR__ . '/..'));

// Tampilkan error jika ada masalah
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    // Jika sesi tidak ada tetapi cookie ada, autentikasi pengguna
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_COOKIE['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Set ulang sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_full_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_profile_picture'] = $user['profile_picture'];
    }
}

$host = 'localhost';
$dbname = 'ikea';
$username = 'root';
$password = '';
$dbname = 'ikea';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}


// MySQLi Connection (new - for brandlist.php)
try {
    $connection = new mysqli($host, $username, $password, $dbname);
    
    // Check connection
    if ($connection->connect_error) {
        die("MySQLi Connection failed: " . $connection->connect_error);
    }
    
    // Set charset
    $connection->set_charset("utf8mb4");
    
} catch (Exception $e) {
    die("MySQLi Connection error: " . $e->getMessage());
}

// Add compatibility variables for legacy code
$servername = $host;  // Make $servername available
$conn = $connection;  // Use the existing $connection as $conn

// Session handling (existing code)
if (!isset($_SESSION['user_id']) && isset($_COOKIE['user_id'])) {
    // Jika sesi tidak ada tetapi cookie ada, autentikasi pengguna
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$_COOKIE['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Set ulang sesi
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_full_name'] = $user['full_name'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_profile_picture'] = $user['profile_picture'];
    }
}
?>


