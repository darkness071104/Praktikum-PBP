<?php
require_once('lib/db_login.php');

if (isset($_GET['title'])) {
    $title = $_GET['title'];
} else {
    die('Missing title parameter.');
}

$query = "SELECT * FROM books 
          WHERE title LIKE '%" . $title . "%'";

$result = $db->query($query);

if (!$result) {
    die("Could not query the database: <br>" . $db->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_object()) {
        echo '<div class="card mb-3">';
        echo '<div class="card-header">Title: ' . $row->title . '</div>';
        echo '<div class="card-body">';
        echo 'ISBN: ' . $row->isbn . '<br>';
        echo 'Author: ' . $row->author . '<br>';
        echo 'Price: ' . $row->price . '<br>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo 'No books found.';
}

$result->free();
$db->close();
?>