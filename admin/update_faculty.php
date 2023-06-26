<?php
// Connect to the database
require '../php_files/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $pass = $_POST['pass'];
    $dept = $_POST['dept'];

    // Update the faculty details in the database
    $sql = "UPDATE tbl_faculty SET username = '$username', password = '$pass', faculty='$dept' WHERE id = '$id'";
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
