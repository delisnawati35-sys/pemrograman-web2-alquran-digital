<?php
session_start();

/*
|--------------------------------------------------------------------------
| Cek Session Login
|--------------------------------------------------------------------------
*/

if(isset($_SESSION['login'])){

    header("Location: dashboard.php");

}else{

    header("Location: auth/login.php");

}

exit;
?>