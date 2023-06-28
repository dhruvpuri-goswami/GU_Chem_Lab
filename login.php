<?php
session_start();

require './php_files/connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userType = $_POST["user_type"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    switch ($userType) {
        case "Student":
            $table = "tbl_student";
            $loc = "Location: ./student/student_dashboard.php";
            break;
        case "Faculty":
            $table = "tbl_faculty";
            $loc = "Location: ./faculty/faculty_dashboard.php";
            break;
        case "LAB HEAD":
            $table = "tbl_lab_head";
            $loc = "Location: ./lab_head/lab_head_dashboard.php";
            break;
        case "HOD":
            $table = "tbl_hod";
            $loc = "Location: ./hod/hod_dashboard.php";
            break;
        case "ADMIN":
            if ($username === "admin" && $password === "admin") {
                $_SESSION["username"] = "Admin";
                header("Location: ./admin/admin_dashboard.php");
                exit();
            }
            break;
        default:
            echo '<script type ="text/JavaScript">';
            echo 'alert("Invalid User Type Selected !!")';
            echo '</script>';
            exit();
    }

    $sql = "SELECT * FROM $table WHERE id = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);


    if ($result && mysqli_num_rows($result) > 0) {
        $_SESSION["username"] = $username;
        header($loc);
        exit();
    } else {
        echo '<script type ="text/JavaScript">';
        echo 'alert("Invalid Username or Password !!")';
        echo '</script>';
    }

    mysqli_close($conn);
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <title>College Chemical Lab Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <style>
    body {
      background: #f2f2f2;
      background: linear-gradient(to right, #f2f2f2, #c2c2c2);
    }
    .card {
      border-radius: 15px;
      background: rgba( 150, 150, 150, 0.25 );
      box-shadow: 0 8px 32px 0 rgba( 31, 38, 135, 0.37 );
      backdrop-filter: blur( 8.0px );
      -webkit-backdrop-filter: blur( 8.0px );
      border: 1px solid rgba( 255, 255, 255, 0.18 );
      transition: all 0.3s ease;
    }
    .card:hover {
      transform: translateY(-10px);
    }
    .form-control:focus {
      box-shadow: none;
      border-color: #5cb85c;
    }
    .btn-primary {
      background-color: #01265e;
      border-color: #01265e;
      color: #ffffff;
      width: 100%;
      margin-top: 10px;
    }
    .text-center {
      font-size: 1.8rem;
      font-weight: bold;
      color: #000000;
    }
    @keyframes slideInFromLeft {
      0% { transform: translateY(-30%); }
      100% { transform: translateY(0); }
    }
    .row.justify-content-center {
      animation: 1s ease-out 0s 1 slideInFromLeft;
    }
  </style>
</head>
<body>
<div class="container">
  <div class="row justify-content-center align-items-center" style="height:100vh">
      <div class="col-12 col-md-6">
          <div class="card p-5">
              <div class="card-body">
                  <form action="" autocomplete="off" method="POST">
                      <div class="form-group">
                          <label class="text-center mb-4" for="user_type" style="display: block;">Login as</label>
                          <select id="user_type" class="form-control" name="user_type" required>
                              <option>Student</option>
                              <option>Faculty</option>
                              <option>LAB HEAD</option>
                              <option>HOD</option>
                              <option>ADMIN</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <input type="text" class="form-control" name="username" id="username" placeholder="User ID" required>
                      </div>
                      <div class="form-group">
                          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                      </div>
                      <div class="form-group text-center">
                        <button type="submit" id="sendlogin" class="btn btn-primary">Login</button>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
