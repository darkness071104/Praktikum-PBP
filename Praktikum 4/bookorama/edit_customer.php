<!-- Nama       : Fauzan Ramadhan Putra
     Nim        : 24060121140140
     Tanggal    : 26 September 2023
     Lab        : PBP A1
 -->
<?php
    require_once('lib/db_login.php');
    $id = test_input($_GET['id']);

    //mengecek apakah user belum menekan tombol submit
    if (!isset($_POST['submit'])){
        $query = "SELECT * FROM customers WHERE customerid=" . $id;
        // Execute the query
        $result = $db->query($query);
        if (!$result) {
            die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
        } else {
            while ($row = $result->fetch_object()) {
            $name = $row->name;
            $address = $row->address;
            $city = $row->city;
            }
        }
    } else {
        $valid = TRUE; //flag validasi
        $name = test_input($_POST['name']);
        $address = test_input($_POST['address']);
        $city = test_input($_POST['city']);

        //cek nama
        if ($name == '') {
            $error_name = "Name is required";
            $valid = FALSE;
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $error_name = "Only letters and white space allowed";
            $valid = FALSE;
        }

        //cek alamat
        if ($address == '') {
            $error_address = "Address is required";
            $valid = FALSE;
        }

        //cek kota
        if ($city == '') {
            $error_city = "City is required";
            $valid = FALSE;
        } elseif (!preg_match("/^[a-zA-Z ]*$/", $city)) {
            $error_city = "Only letters and white space allowed";
            $valid = FALSE;
        }

        //update data into database
        if ($valid) {
            //escape inputs data
            $name = $db->real_escape_string($name);
            $address = $db->real_escape_string($address);
            $city = $db->real_escape_string($city);

            //assign a query
            $query = "UPDATE customers SET name='" . $name . "', address='" . $address . "', city='" . $city . "' WHERE customerid=" . $id;

            //execute the query
            $result = $db->query($query);
            if (!$result) {
                die("Could not query the database: <br>" . $db->error . "<br>Query: " . $query);
            } else {
                $db->close();
                header('Location: view_customer.php');
            }
        }
    }
?>
<?php include('./header.php') ?>
<br>
<div class="card mt-4">
    <div class="card-header">Edit Customers Data</div>
    <div class="card-body">
        <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']) . '?id=' . $id ?>" method="POST" autocomplete="on">
            <div class="form-group">
                <label for="name">Nama:</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $name; ?>">
                <div class="error"><?php if (isset($error_name)) echo $error_name ?></div>
            </div>
            <div class="form-group">
                <label for="name">Address:</label>
                <textarea class="form-control" name="address" id="address" rows="5"><?php echo $address; ?></textarea>
                <div class="error"><?php if (isset($error_address)) echo $error_address ?></div>
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <select name="city" id="city" class="form-control" required>
                    <option value="none" <?php if (!isset($city)) echo 'selected' ?>>--Select a city--</option>
                    <option value="Airport West" <?php if (isset($city) && $city == "Airport West") echo 'selected' ?>>Airport West</option>
                    <option value="Box Hill" <?php if (isset($city) && $city == "Box Hill") echo 'selected' ?>>Box Hill</option>
                    <option value="Yarraville" <?php if (isset($city) && $city == "Yarraville") echo 'selected' ?>>Yarraville</option>
                </select>
                <div class="error"><?php if (isset($error_city)) echo $error_city ?></div>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
            <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
<?php include('./footer.php') ?>
<?php
$db->close();
?>