<?php
require_once('lib/db_login.php');

// Check if 'name', 'address', and 'city' parameters are set in the URL
if (isset($_GET['name']) && isset($_GET['address']) && isset($_GET['city'])) {
    $name = $db->real_escape_string($_GET['name']);
    $address = $db->real_escape_string($_GET['address']);
    $city = $db->real_escape_string($_GET['city']);
    
    $query = "INSERT INTO customers (name, address, city) VALUES ('$name', '$address', '$city')";
    $result = $db->query($query);

    if (!$result) {
        echo '<div class="alert alert-danger alert-dismissible">
                <strong>Error!</strong> Could not query the database<br>' .
        $db->error . '<br>query = ' . $query .
        '</div>';
    } else {
        echo '<div class="alert alert-success alert-dismissible">
                <strong>Success!</strong> Data has been added.<br>
                Name : ' . $name . '<br>
                Address : ' . $address . '<br>
                City : ' . $city . '<br>
            </div>';
    }
} else {
    // Handle the case where 'name', 'address', or 'city' are not provided in the URL
    echo '<div class="alert alert-danger alert-dismissible">
            <strong>Error!</strong> Please provide values for "name," "address," and "city" in the URL.
          </div>';
}

$db->close();
?>
