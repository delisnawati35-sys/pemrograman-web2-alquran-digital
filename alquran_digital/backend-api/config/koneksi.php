<?php

require_once __DIR__ . '/env.php';

$host = getenv('DB_HOST');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$db   = getenv('DB_DATABASE');
$port = getenv('DB_PORT');

$conn = mysqli_connect($host, $user, $pass, $db, $port);


if (!$koneksi) {
    die("Koneksi Database Gagal : " . mysqli_connect_error());
}

date_default_timezone_set('Asia/Jakarta');
