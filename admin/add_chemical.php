<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}

// Get the form data
$chem_no = $_POST['chem_id'];
$chem_name = $_POST['chem_name'];
$chem_loc = $_POST['chem_loc'];
$chem_quan = $_POST['chem_quan'];

// Connect to the database
require '../php_files/connection.php';

// Prepare the SQL query
$sql = "INSERT INTO tbl_chemical (chem_id, chem_name, chem_loc, chem_quan) VALUES ('$chem_no','$chem_name', '$chem_loc', '$chem_quan')";

// Execute the query
if (mysqli_query($conn, $sql)) {
    // Redirect to the page with the updated chemical details
    header("Location: admin_dashboard.php");
    exit();
} else {
    // Handle error if the query fails
    echo "Error: " . mysqli_error($conn);
}

mysqli_close($conn);
?>
