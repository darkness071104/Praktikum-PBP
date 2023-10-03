<!-- Nama       : Fauzan Ramadhan Putra
     Nim        : 24060121140140
     Tanggal    : 18 September 2023
     Lab        : PBP A1
 -->

<!DOCTYPE HTML>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tugas Pembuatan Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <script>
        function kelaspilihan() {
            var kelas = document.forms['form_input_siswa']['kelas'].value;
            var ekstra = document.getElementById("ekstrakulikuler");
            if (kelas == 'XII') {
                ekstra.style.display = 'none';
            } else {
                ekstra.style.display = 'block';
            }
        }

        function resetform() {
            document.getElementById("form_input_siswa").reset();
            var ekstra = document.getElementById("ekstrakulikuler");
            ekstra.style.display = 'block';
        }
    </script>
</head>
<body>
    <div class="card m-5">
        <div class="card-header">Tugas Pembuatan Form</div>
        <div class="card-body">
            <?php
            // validasi NIS
            if (isset($_POST['submit'])) {
                // validasi nis
                $nis = test_input($_POST['nis']);
                if (empty($nis)) {
                    $error_nis = 'Nis harus diisi';
                } else if (!preg_match("/^[0-9]*$/", $nis)) {
                    $error_nis = "Nis berisi angka";
                } else if (strlen($nis) != 10) {
                    $error_nis = "Nis harus 10 angka!";
                }
                // validasi nama
                $nama = test_input($_POST['nama']);
                if (empty($nama)) {
                    $error_nama = 'Nama harus diisi';
                } else if (!preg_match("/^[a-zA-Z ]*$/", $nama)) {
                    $error_nama = "Nama hanya dapat berisi huruf dan spasi";
                }
                // validasi jenis kelamin
                if (empty($_POST['jenis_kelamin'])) {
                    $error_jenis_kelamin = 'Jenis kelamin harus diisi';
                } else {
                    $jenis_kelamin = $_POST['jenis_kelamin'];
                }
                // validasi kelas
                $kelas = $_POST['kelas'];
                if ($kelas == '' || $kelas == 'kelas') {
                    $error_kelas = "Kelas harus diisi!";
                }

                // validasi ekskul
                if (empty($_POST['ekskul']) && $kelas != 'XII') {
                    $error_ekskul = 'Ekstrakurikuler harus diisi';
                } elseif ($kelas != 'XII') {
                    $ekskul = $_POST['ekskul'];
                    if (count($ekskul) > 3) {
                        $error_ekskul = 'Ektrakurikuler yang dipilih maksimal 3';
                    }
                }
            }

            function test_input($data)
            {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            ?>
            <form method="POST" id="form_input_siswa" autocomplete="on" action="">
                <div class="form-group">
                    <label for="nis">NIS</label>
                    <input type="text" class="form-control" id="nis" name="nis" value="<?php if (isset($nis)) {
                                                                                            echo $nis;
                                                                                        } ?>">
                    <div class="error"> <?php if (isset($error_nis))
                                            echo $error_nis;
                                        ?></div>
                </div>
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php if (isset($nama)) {
                                                                                                echo $nama;
                                                                                            } ?>">
                    <div class="error"> <?php if (isset($error_nama)) {
                                            echo $error_nama;
                                        } ?></div>
                </div>
                <label>Jenis Kelamin</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="pria" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "pria") {
                                                                                                            echo 'checked';
                                                                                                        } ?>>Pria</label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jenis_kelamin" value="wanita" <?php if (isset($jenis_kelamin) && $jenis_kelamin == "wanita") {
                                                                                                                echo 'checked';
                                                                                                            } ?>>Wanita</label>
                    <div class="error"><?php if (isset($error_jk)) {
                                            echo $error_jk;
                                        } ?></div>
                </div>
                <div class="form-option">
                    <label>Kelas:</label>
                    <select class="form-select" aria-label="Default select example" id="kelas" name="kelas" onchange="kelaspilihan()">
                        <option value="X" <?php if (isset($kelas) && $kelas == "X") {
                                                echo 'selected="true"';
                                            } ?>>X</option>
                        <option value="XI" <?php if (isset($kelas) && $kelas == "XI") {
                                                echo 'selected="true"';
                                            } ?>>XI</option>
                        <option value="XII" <?php if (isset($kelas) && $kelas == "XII") {
                                                echo 'selected="true"';
                                            } ?>>XII</option>
                    </select>
                    <div class="error"><?php if (isset($error_kelas)) {
                                            echo $error_kelas;
                                        } ?></div>
                </div>
                <br>
                <div id="ekstrakulikuler">
                    <label>Ekstrakulikuler:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekskul[]" value="pramuka" <?php if (isset($ekskul) && in_array('pramuka', $ekskul)) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexCheckDefault">Pramuka</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekskul[]" value="seni tari" <?php if (isset($ekskul) && in_array('seni tari', $ekskul)) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexCheckDefault">Seni Tari</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekskul[]" value="sinematografi" <?php if (isset($ekskul) && in_array('sinematografi', $ekskul)) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexCheckDefault">Sinematografi</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="ekskul[]" value="basket" <?php if (isset($ekskul) && in_array('basket', $ekskul)) echo 'checked'; ?>>
                        <label class="form-check-label" for="flexCheckDefault">Basket</label>
                    </div>
                    <div class="error"><?php if (isset($error_ekskul)) echo $error_ekskul; ?></div>
                    <br>
                </div>
                <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <button type="reset" class="btn btn-danger" onclick="resetform()">Reset</button>
            </form>
            
            <?php
            if (isset($_POST['submit']) && empty($error_nis) && empty($error_nama) && empty($error_jenis_kelamin) && empty($error_kelas) && empty($error_ekskul)) {
                echo "<h3>Your Input</h3>";
                echo "NIS : " . $_POST['nis'] . '<br>';
                echo "Nama : " . $_POST['nama'] . '<br>';
                echo "Jenis Kelamin : ";

                if (isset($_POST['jenis_kelamin'])) {
                    echo $_POST['jenis_kelamin'];
                }
                echo '<br>';
                echo "Kelas : " . $_POST['kelas'] . '<br>';
                echo 'Ekstrakurikuler yang dipilih : ';
                if (!empty($ekskul)) {
                    $ekskul = $_POST['ekskul'];
                    foreach ($ekskul as $ekskul_pilihan) {
                        echo '<br>' . $ekskul_pilihan;
                    }
                }
            }
            ?>
        </div>
    </div>
</body>
</html>