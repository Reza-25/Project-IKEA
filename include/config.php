<?php
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
?>