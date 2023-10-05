<?php
// Nama : Fauzan Ramadhan Putra
// Nim  : 24060121140140
// lab  : A1

include('header.html');

require_once 'lib/db_login.php';

/*TODO 2 : Buatlah
1. server side validation
2. insert new user
3. tampilkan hasilnya error/berhasil */

$nama = $email = $gender = $alamat = $provinsi = $kabupaten = "";
$error_nama = $error_email = $error_gender = $error_alamat = $error_provinsi = $error_kabupaten = "";
$error_message = "";

if (isset($_POST['submit'])) {
  $submit = true;
  // Validasi nama
  if (empty($_POST['nama'])) {
    $error_nama = "Nama tidak boleh kosong";
    $submit = false;
  } else {
    $nama = $db->real_escape_string(trim($_POST['nama']));
  }

  // Validasi email
  if (empty($_POST['email'])) {
    $error_email = "Email tidak boleh kosong";
    $submit = false;
  } else {
    // cek format email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      $error_email = "Email tidak valid";
      $submit = false;
    } else {
      $email = $db->real_escape_string(trim($_POST['email']));
      // Email is already registered
      $query = "SELECT * FROM tb_user WHERE email = '$email'";
      $result = $db->query($query);
      if ($result->num_rows > 0) {
        $error_email = "Email sudah terdaftar";
        $submit = false;
      }
    }
  }

  // validasi gender
  if (empty($_POST['gender'])) {
    $error_gender = "Gender tidak boleh kosong";
    $submit = false;
  } else {
    $gender = $db->real_escape_string(trim($_POST['gender']));
  }

  // validasi alamat
  if (empty($_POST['alamat'])) {
    $error_alamat = "Alamat tidak boleh kosong";
    $submit = false;
  } else {
    $alamat = $db->real_escape_string(trim($_POST['alamat']));
  }

  // validasi provinsi
  if (empty($_POST['provinsi'])) {
    $error_provinsi = "Provinsi tidak boleh kosong";
    $submit = false;
  } else {
    $provinsi = $db->real_escape_string(trim($_POST['provinsi']));
  }

  // validasi kabupaten
  if (empty($_POST['kabupaten'])) {
    $error_kabupaten = "Kabupaten tidak boleh kosong";
    $submit = false;
  } else {
    $kabupaten = $db->real_escape_string(trim($_POST['kabupaten']));
  }

  if ($submit) {
    $query = "INSERT INTO tb_user (nama, email, jenis_kelamin, alamat, kode_prov, kode_kab) VALUES ('$nama', '$email', '$gender', '$alamat', $provinsi, $kabupaten)";
    $result = $db->query($query);

    if (!$result) {
      $success = false;
      $error_message = "Gagal mendaftar!";
    } else {
      $success = true;
      $nama = "";
      $email = "";
      $gender = "";
      $alamat = "";
      $provinsi = "";
      $kabupaten = "";
    }
    $db->close();
  }
}
?>

<div class="card">
  <?php if (isset($success)) : ?>
    <?php if ($success) : ?>
    <?php else : ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $error_message ?>
      </div>
    <?php endif; ?>
  <?php endif; ?>
    <div class="card-header">Form Input Pendaftaran</div>
    <div class="card-body">
        <!-- TODO 3 : definisikan method dan actions pada tags <form> -->
        <form name="daftar" method="POST" action="">
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?php echo htmlspecialchars($nama); ?>">
                <div id="error_name" style="color: red;">
                    <?php if (isset($error_nama))  echo $error_nama ?>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <!-- TODO 4 : buatlah cek email menggunakan ajax -->
                <input type="email" name="email" id="email" class="form-control" oninput="getUser()" value="<?php echo htmlspecialchars($email); ?>">
                <div id="error_email" style="color: red;">
                    <?php if (isset($error_email))  echo $error_email ?>
                </div>
            </div>
            <label>Jenis Kelamin</label>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="Laki-laki" <?php if ($gender === "Laki-laki") echo "checked"; ?>>Laki-laki
                </label>
            </div>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="gender" value="Perempuan" <?php if ($gender === "Perempuan") echo "checked"; ?>>Perempuan
                </label>
            </div>
            <div id="error_gender" style="color: red; margin-bottom: 12px;">
                <?php if (isset($error_gender))  echo $error_gender ?>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea name="alamat" id="alamat" rows="3" class="form-control"><?php echo htmlspecialchars($alamat); ?></textarea>
                <div id="error_alamat" style="color: red;">
                    <?php if (isset($error_alamat))  echo $error_alamat ?>
                </div>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <select onchange="getKabupaten(this.value)" name="provinsi" id="provinsi" class="form-control">
                    <option value="">Pilih Provinsi</option>
                    <?php require_once('get_provinsi.php'); ?>
                </select>
                <div id="error_provinsi" style="color: red;">
                    <?php if (isset($error_provinsi))  echo $error_provinsi ?>
                </div>
            </div>
            <div class="form-group">
                <label for="kabupaten">Kabupaten</label>
                <select name="kabupaten" id="kabupaten" class="form-control">
                    <option value="">Pilih kabupaten</option>
                    <!-- TODO 5 : tampilkan daftar kabupaten berdasarkan pilihan provinsi yang dipilih, menggunakan ajax -->
                </select>
                <div id="error_kabupaten" style="color: red;">
                    <?php if (isset($error_kabupaten))  echo $error_kabupaten ?>
                </div>
            </div>
            <br>
            <button id ="submit" type="submit" name="submit" value="submit" class="btn btn-primary container-fluid">Daftar</button>
        </form>
    </div>
</div>

<?php include('footer.html') ?>