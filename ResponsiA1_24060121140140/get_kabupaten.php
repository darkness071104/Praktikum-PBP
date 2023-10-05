<?php
// Nama : Fauzan Ramadhan Putra
// Nim  : 24060121140140
// lab  : A1

require_once 'lib/db_login.php';

/* TODO 6 : mengambil data kabupaten dari tabel 'tb_kabs' dengan parameter kode_prov*/
$kode_prov = $_GET['kode_prov'];
$query = "SELECT * FROM tb_kabs WHERE kode_prov = $kode_prov";
$result = $db->query($query);
if (!$result) {
    die("Could not query the database: <br/>" . $db->error);
} else {
    echo "<option disabled selected value=''>Pilih Kabupaten</option>";
    while ($row = $result->fetch_object()) {
        echo "<option value='" . $row->kode_kab . "'>" . $row->nama_kab . "</option>";
    }
}
?>






