<?php 
// Nama : Fauzan Ramadhan Putra
// Nim  : 24060121140140
// lab  : A1

// TODO 1: Buatlah koneksi dengan database
$db_host = "localhost:3307";
$db_database = "responsi";
$db_username = "root";
$db_password = "";

// Connect Database
$db = new mysqli($db_host, $db_username, $db_password, $db_database);
if($db->connect_errno){
    die("Could not connect to the database: <br />".$db->connect_error);
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>