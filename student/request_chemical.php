<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["username"])) {
    header("Location: ../login.php");
    exit();
}

// Get the username from the session
$username = $_SESSION["username"];

// Connect to the database and fetch chemical details
require '../php_files/connection.php';


$studentDetails = "SELECT * FROM tbl_student WHERE id = '$username'";
$resultStudent = mysqli_query($conn, $studentDetails);
$rowStudent = mysqli_fetch_assoc($resultStudent);
$studentLab = $rowStudent['lab'];

$sql = "SELECT * FROM tbl_request WHERE requested_by = '$username'";
$result = mysqli_query($conn, $sql);
$count=0;

$requests = [];
while ($row = mysqli_fetch_assoc($result)) {
    $requests[] = $row;
}
if (isset($_POST['submit'])) {
    $studentID = $username; // Assuming you have a student ID stored in the session
    $chemicalID = $_POST["chemical_id"];
    $chemical_quan = $_POST['chemical_quan'];

    if($chemical_quan > 0){
        echo '<script>';
        echo 'alert("You cannot request for chemical!")';
        echo '</script>';
    }
    else{
        // Check if the requested chemical is available in the student's lab
        $sql = "SELECT chem_loc, chem_quan FROM tbl_chemical WHERE chem_id = '$chemicalID' AND chem_quan > 0 ORDER BY chem_quan DESC LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        if ($row !== null) {
            $labID = $row["chem_loc"];
            $count = mysqli_num_rows($result);
        }

        if($count > 0){
            // Check if the student has already requested the chemical
            $existingRequestQuery = "SELECT * FROM tbl_lab_request WHERE chem_id = '$chemicalID' AND lab_id = '$labID' AND request_lab_id = '$studentLab'";
            $existingRequestResult = mysqli_query($conn, $existingRequestQuery);
            $existingRequestCount = mysqli_num_rows($existingRequestResult);
            if($existingRequestCount > 0){
                echo '<script>';
                echo 'alert("You have already requested this chemical!")';
                echo '</script>';
            }
            else{
                $sql = "INSERT INTO tbl_lab_request (chem_id,lab_id,request_lab_id) VALUES ('$chemicalID','$labID','$studentLab')";
                $insertRequest = mysqli_query($conn,$sql);
                if($insertRequest){
                    echo '<script>';
                    echo 'alert("Chemical Requested Successfully !!")';
                    echo '</script>';
                }
                else{
                    echo '<script>';
                    echo 'alert("Please try after some time !!")';
                    echo '</script>';
                }
            }
        }
        else {
            // Check if the student has already requested the chemical
            $existingRequestQuery = "SELECT * FROM tbl_request WHERE chem_id = '$chemicalID' AND requested_by = '$username'";
            $existingRequestResult = mysqli_query($conn, $existingRequestQuery);
            $existingRequestCount = mysqli_num_rows($existingRequestResult);
        
            if ($existingRequestCount > 0) {
                echo '<script>';
                echo 'alert("You have already requested this chemical!")';
                echo '</script>';
            } else {
                $sql = "INSERT INTO tbl_request(chem_id, requested_by, lab_head_status, hod_status) VALUES ('$chemicalID', '$username', '0', '0')";
                $insertRequest = mysqli_query($conn, $sql);
                if ($insertRequest) {
                    echo '<script>';
                    echo 'alert("Chemical Requested Successfully !!")';
                    echo '</script>';
                } else {
                    echo '<script>';
                    echo 'alert("Please try after some time !!")';
                    echo '</script>';
                }
            }
        }
        
    }
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>CHEMICAL LAB</title>
    <!-- Custom fonts for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <!-- Custom styles for this template-->
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="student_dashboard.php">
                <div class="sidebar-brand-text mx-3">CHEMICAL LAB<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="student_dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>CHEMICALS</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">


            <!-- Heading -->
            <div class="sidebar-heading">
                Requests
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>REQUESTS</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">REQUESTS</h6>
                        <a class="collapse-item" href="request_chemical.php">My REQUESTS</a>
                    </div>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $username; ?></span>
                                <img class="img-profile rounded-circle" src="../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Download Data</a>
                    </div>

                    <!-- Chemical Details Table -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Chemical Details</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Chemical ID</th>
                                            <th>Chemical Name</th>
                                            <th>Requested By</th>
                                            <th>Lab Head Status</th>
                                            <th>HOD Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $count = 1; foreach ($requests as $req) : ?>
                                            <tr>
                                                <td><?php echo $count++; ?></td>
                                                <td><?php echo $req['chem_id']; ?></td>
                                                <td>
                                                    <?php 
                                                        // Get the chem_id from somewhere (e.g., $req["chem_id"])
                                                        $chem_id = $req["chem_id"];

                                                        // Prepare and execute the SQL query
                                                        $sql = "SELECT chem_name FROM tbl_chemical WHERE chem_id = '$chem_id' LIMIT 1";
                                                        $result = mysqli_query($conn, $sql);
                                                        $row = mysqli_fetch_assoc($result);
                                                        $chem_name = $row["chem_name"];
                                                        echo $chem_name;
                                                    ?>
                                                </td>
                                                <td><?php echo $req['requested_by']; ?></td>
                                                <?php
                                                    $data = $req['lab_head_status'];
                                                    $case;

                                                    switch ($data) {
                                                        case 1:
                                                            $case = '<button type="button" class="btn btn-success btn-sm btn-nocursor">Approved</button>';
                                                            break;
                                                        case -1:
                                                            $case = '<button type="button" class="btn btn-danger btn-sm btn-nocursor">Denied</button>';
                                                            break;
                                                        case 0:
                                                            $case = '<button type="button" class="btn btn-primary btn-sm btn-nocursor">Pending</button>';
                                                            break;
                                                    }
                                                ?>

                                                <td><?php echo $case; ?></td>
                                                <?php
                                                    $data = $req['hod_status'];
                                                    $case;

                                                    switch ($data) {
                                                        case 1:
                                                            $case = '<button type="button" class="btn btn-success btn-sm btn-nocursor">Approved</button>';
                                                            break;
                                                        case -1:
                                                            $case = '<button type="button" class="btn btn-danger btn-sm btn-nocursor">Denied</button>';
                                                            break;
                                                        case 0:
                                                            $case = '<button type="button" class="btn btn-primary btn-sm btn-nocursor">Pending</button>';
                                                            break;
                                                    }
                                                ?>

                                                <td><?php echo $case; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="text-center">
                        <span>Gujarat University</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>
</body>

</html>
<?php
mysqli_close($conn);
?>
