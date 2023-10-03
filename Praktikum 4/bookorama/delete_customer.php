<!-- Nama       : Fauzan Ramadhan Putra
     Nim        : 24060121140140
     Tanggal    : 26 September 2023
     Lab        : PBP A1
 -->
<?php
// Sertakan file koneksi database
require_once('lib/db_login.php');

// Include header.php
include('header.php');

// Periksa apakah parameter 'id' diberikan
if (isset($_GET['id'])) {
    // Bersihkan masukan ID pelanggan
    $customer_id = mysqli_real_escape_string($db, $_GET['id']);

    // Query untuk mengambil informasi pelanggan berdasarkan ID
    $query = "SELECT * FROM customers WHERE customerid = '$customer_id'";
    $result = $db->query($query);

    if (!$result) {
        die('Tidak dapat mengambil data dari database: <br/>' . $db->error);
    }

    if ($result->num_rows === 1) {
        // Ambil data pelanggan yang ingin dihapus
        $row = $result->fetch_object();
        $customer_name = $row->name;

        // Periksa apakah form dikirimkan untuk menghapus pelanggan
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Query untuk menghapus pelanggan berdasarkan ID
            $deleteQuery = "DELETE FROM customers WHERE customerid = '$customer_id'";

            if ($db->query($deleteQuery) === TRUE) {
                // Jika penghapusan berhasil, arahkan kembali ke halaman view_customer
                header("Location: view_customer.php");
                exit();
            } else {
                echo '<div class="alert alert-danger">Error: ' . $db->error . '</div>';
            }
        }
    } else {
        echo '<div class="alert alert-warning">Pelanggan dengan ID tersebut tidak ditemukan.</div>';
    }
} else {
    echo '<div class="alert alert-danger">ID pelanggan tidak diberikan.</div>';
}
?>

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Konfirmasi Hapus Pelanggan</h2>
        </div>
        <div class="card-body">
            <p>Anda akan menghapus pelanggan dengan data berikut:</p>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Kota</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Menampilkan data pelanggan yang ingin dihapus
                    echo '<tr>';
                    echo '<td>' . $row->customerid . '</td>';
                    echo '<td>' . $row->name . '</td>';
                    echo '<td>' . $row->address . '</td>';
                    echo '<td>' . $row->city . '</td>';
                    echo '</tr>';
                    ?>
                </tbody>
            </table>
            <p>Apakah Anda yakin ingin menghapus pelanggan ini?</p>
            <form method="POST">
                <button type="submit" class="btn btn-danger">Hapus</button>
                <a class="btn btn-secondary" href="view_customer.php">Batal</a>
            </form>
        </div>
    </div>
</div>

<?php
// Include footer.php
include('footer.php');
?>
