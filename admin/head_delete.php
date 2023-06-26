<?php
// Connect to the database
require '../php_files/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];

    $sql = "DELETE FROM tbl_lab_head WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Update successful
        echo 'success';
    } else {
        // Update failed
        echo 'error';
    }
}

// Close the database connection
mysqli_close($conn);
?>
