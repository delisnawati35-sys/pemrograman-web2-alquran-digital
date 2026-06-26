<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once __DIR__ . '/vendor/autoload.php';
include 'config/koneksi.php';
require_once __DIR__ . '/config/cloudinary.php';

use Cloudinary\Api\Upload\UploadApi;

/*
|--------------------------------------------------------------------------
| Proteksi Login
|--------------------------------------------------------------------------
*/
if(!isset($_SESSION['login'])){
    header("Location: auth/login.php");
    exit;
}

/*
|--------------------------------------------------------------------------
| Ambil Data Form
|--------------------------------------------------------------------------
*/
$kode_materi        = mysqli_real_escape_string($koneksi,$_POST['kode_materi']);
$nama_materi        = mysqli_real_escape_string($koneksi,$_POST['nama_materi']);
$kategori_materi    = mysqli_real_escape_string($koneksi,$_POST['kategori_materi']);
$tingkat_kesulitan  = mysqli_real_escape_string($koneksi,$_POST['tingkat_kesulitan']);
$deskripsi          = mysqli_real_escape_string($koneksi,$_POST['deskripsi']);
$target_pembelajaran= mysqli_real_escape_string($koneksi,$_POST['target_pembelajaran']);
$tanggal_input      = $_POST['tanggal_input'];
$status_materi      = $_POST['status_materi'];


/*
|--------------------------------------------------------------------------
| Upload Gambar ke Cloudinary
|--------------------------------------------------------------------------
*/
$errorFile = $_FILES['gambar_materi']['error'];

if ($errorFile == 0) {

    $ekstensiValid = ['jpg','jpeg','png'];

    $namaFile = $_FILES['gambar_materi']['name'];
    $tmpFile  = $_FILES['gambar_materi']['tmp_name'];

    $ekstensi = strtolower(pathinfo($namaFile, PATHINFO_EXTENSION));

    if (!in_array($ekstensi, $ekstensiValid)) {
        echo "
        <script>
            alert('Format gambar harus JPG, JPEG, atau PNG');
            window.location='tambah.php';
        </script>
        ";
        exit;
    }

    try {

        $upload = (new UploadApi())->upload(
            $tmpFile,
            [
                'folder' => 'alquran_digital'
            ]
        );

        $namaBaru = $upload['secure_url'];

    } catch (Exception $e) {

        die("Upload Cloudinary gagal : " . $e->getMessage());

    }

} else {

    die("Upload file gagal.");

}
/*
|--------------------------------------------------------------------------
| Simpan ke Database
|--------------------------------------------------------------------------
*/
$query = mysqli_query(
    $koneksi,
    "INSERT INTO materi_pembelajaran
    (
        kode_materi,
        nama_materi,
        kategori_materi,
        tingkat_kesulitan,
        deskripsi,
        target_pembelajaran,
        tanggal_input,
        status_materi,
        gambar_materi
    )
    VALUES
    (
        '$kode_materi',
        '$nama_materi',
        '$kategori_materi',
        '$tingkat_kesulitan',
        '$deskripsi',
        '$target_pembelajaran',
        '$tanggal_input',
        '$status_materi',
        '$namaBaru'
    )"
);

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/
if($query){

    echo "
    <script>
        alert('Data berhasil disimpan');
        window.location='materi.php';
    </script>
    ";

}else{

    echo "
    <script>
        alert('Data gagal disimpan');
        window.location='tambah.php';
    </script>
    ";

}
?>
