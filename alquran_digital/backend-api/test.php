<?php
include 'config/koneksi.php';

echo "Koneksi Database Berhasil";
?>

<?php
if (function_exists('mysqli_connect')) {
    echo "mysqli READY";
} else {
    echo "mysqli NOT AVAILABLE";
}