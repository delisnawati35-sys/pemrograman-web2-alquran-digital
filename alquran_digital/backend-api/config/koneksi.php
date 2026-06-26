<?php

include __DIR__ . '/../backend-api/config/koneksi.php';

$host = $_ENV['DB_HOST'];
$port = $_ENV['DB_PORT'];
$user = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

$koneksi = mysqli_connect(
    $host,
    $user,
    $password,
    $database,
    $port
);

if (!$koneksi) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');