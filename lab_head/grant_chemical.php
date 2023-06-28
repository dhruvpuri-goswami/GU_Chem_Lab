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


$headDetails = "SELECT * FROM tbl_lab_head WHERE id = '$username'";
$resultHead = mysqli_query($conn, $headDetails);
$rowHead = mysqli_fetch_assoc($resultHead);
$headLab = $rowHead['lab_no'];

$sql = "SELECT * FROM tbl_lab_request WHERE lab_id = '$headLab' AND status = '0'";
$result = mysqli_query($conn, $sql);

$chemicals = [];
while ($row = mysqli_fetch_assoc($result)) {
    $chemicals[] = $row;
}
$count = 1;

if (isset($_POST['approve'])) {
    $chemicalID = $_POST['chemical_id'];
    $quantity = $_POST['quantity'];
    $id = $_POST['id'];
    $labID = $_POST['requested_lab'];
    $studentLab = $headLab;

    // Fetch the initial quantities for the labs
    $sqlQuantities = "SELECT chem_quan, chem_loc FROM tbl_chemical WHERE chem_id = '$chemicalID' AND (chem_loc = '$studentLab' OR chem_loc = '$labID')";
    $resultQuantities = mysqli_query($conn, $sqlQuantities);

    // Store the initial quantities in an associative array
    $initialQuantities = [];
    while ($rowQuantity = mysqli_fetch_assoc($resultQuantities)) {
        $initialQuantities[$rowQuantity['chem_loc']] = $rowQuantity['chem_quan'];
    }

    // Deduct the quantity from the student's lab
    $updatedQuantityStudentLab = $initialQuantities[$studentLab] - $quantity;

    // Credit the quantity to the labID
    $updatedQuantityLabID = $initialQuantities[$labID] + $quantity;

    // Update the quantities in tbl_chemical for the deducted lab
    $sqlUpdateQuantityStudentLab = "UPDATE tbl_chemical SET chem_quan = '$updatedQuantityStudentLab' WHERE chem_id = '$chemicalID' AND chem_loc = '$studentLab'";
    $resultUpdateQuantityStudentLab = mysqli_query($conn, $sqlUpdateQuantityStudentLab);

    // Update the quantities in tbl_chemical for the credited lab
    $sqlUpdateQuantityLabID = "UPDATE tbl_chemical SET chem_quan = '$updatedQuantityLabID' WHERE chem_id = '$chemicalID' AND chem_loc = '$labID'";
    $resultUpdateQuantityLabID = mysqli_query($conn, $sqlUpdateQuantityLabID);

    // Update the status and approved quantity in tbl_lab_request
    $sqlApprove = "UPDATE tbl_lab_request SET status = '1', approved_quan = '$quantity' WHERE id = '$id'";
    $resultApprove = mysqli_query($conn, $sqlApprove);

    if ($resultApprove && $resultUpdateQuantityStudentLab && $resultUpdateQuantityLabID) {
        echo '<script>';
        echo 'alert("Chemical approved. Quantity: '.$quantity.'");';
        echo 'window.location.href = "grant_chemical.php";';
        echo '</script>';
        exit();
    } else {
        echo '<script>';
        echo 'alert("Failed to update the request. Please try again.");';
        echo 'window.location.reload();';
        echo '</script>';
        exit();
    }
}




mysqli_close($conn);
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="lab_head_dashboard.php">
                <div class="sidebar-brand-text mx-3">CHEMICAL LAB<sup>2</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="lab_head_dashboard.php">
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
                        <a class="collapse-item" href="grant_chemical.php">GRANT CHEMICAL</a>
                        <a class="collapse-item" href="purchase_chemical.php">PURCHASE CHEMICAL</a>
                        <a class="collapse-item" href="all_chemical_history.php">TRACK HISTORY</a>
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
                            <h6 class="m-0 font-weight-bold text-primary">Chemical Requests for Lab <?php echo $headLab; ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Chemical ID</th>
                                        <th>Requested Lab</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($chemicals as $chemical) : ?>
                                        <tr>
                                            <td><?php echo $count++; ?></td>
                                            <td><?php echo $chemical['chem_id']; ?></td>
                                            <td><?php echo "Lab " . $chemical['request_lab_id']; ?></td>
                                            <td> 
                                                <form action="" method="post">
                                                    <button type="button" class="btn btn-primary edit-button-student btn-sm" data-toggle="modal" data-target="#quantityModal-<?php echo $chemical['chem_id']; ?>">Approve</button>
                                                    
                                                    <!-- Quantity Modal -->
                                                    <div class="modal fade" id="quantityModal-<?php echo $chemical['chem_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel-<?php echo $chemical['chem_id']; ?>" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="quantityModalLabel-<?php echo $chemical['chem_id']; ?>">Enter Quantity</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <input type="hidden" name="chemical_id" value="<?php echo $chemical['chem_id']; ?>">
                                                                    <div class="form-group">
                                                                        <label for="quantity">Quantity:</label>
                                                                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                                                                        <input type="hidden" name="id" value="<?php echo $chemical['id'] ?>">
                                                                        <input type="hidden" name="requested_lab" value="<?php echo $chemical['request_lab_id'] ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                                    <button type="submit" name="approve" class="btn btn-primary">Confirm</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.container-fluid -->
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
