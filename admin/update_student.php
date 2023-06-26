<?php
// Connect to the database
require '../php_files/connection.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"];
    $username = $_POST["username"];
    $pass = $_POST["pass"];
    $year = $_POST["year"];

    // Update the student details in the database
    $sqlUpdateStudent = "UPDATE tbl_student SET username = '$username', password = '$pass', std_year = '$year' WHERE id = $id";
    if (mysqli_query($conn, $sqlUpdateStudent)) {
        echo "Student details updated successfully";
    } else {
        echo "Error updating student details: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
