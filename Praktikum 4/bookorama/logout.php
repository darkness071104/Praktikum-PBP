<!-- Nama       : Fauzan Ramadhan Putra
     Nim        : 24060121140140
     Tanggal    : 26 September 2023
     Lab        : PBP A1
 -->
<?php
//Deskripsi: Menghapus session yang dibuat saat login
session_start();
if (isset($_SESSION['username'])){
    unset($_SESSION['username']);
    session_destroy();
}
header('Location: login.php');
?>