<!-- Nama       : Fauzan Ramadhan Putra
     Nim        : 24060121140140
     Tanggal    : 26 September 2023
     Lab        : PBP A1
 -->
<?php
//Deskripsi: Menghapus session
session_start();
if(isset($_SESSION['cart'])){
    //Fungsi unset() dapat digunakan untuk membatalkan setel variabel
    unset($_SESSION['cart']);
}
header('Location: view_books.php');
?>
