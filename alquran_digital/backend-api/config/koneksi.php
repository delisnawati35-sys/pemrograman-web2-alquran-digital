<?php

$host = getenv('DB_HOST');
$user = getenv('DB_USERNAME');
$pass = getenv('DB_PASSWORD');
$db   = getenv('DB_DATABASE');
$port = getenv('DB_PORT') ?: 3306;

if (!$host || !$user || !$db) {
    die("ENV DB tidak terbaca");
}

$conn = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conn) {
    die("Koneksi DB gagal: " . mysqli_connect_error());
}

