<?php
// Connect to the database
require '../php_files/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $lab = $_POST['lab'];

    // Update the faculty details in the database
    $sql = "UPDATE tbl_lab_head SET username = '$username', password = '$pass', lab_no='$lab' WHERE id = '$id'";
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
