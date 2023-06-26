<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        .container {
            max-width: 400px;
            margin: 50px auto;
        }

        .btn-primary {
            background-color: #01265e;
            border-color: #01265e;
            color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2e59d9;
        }

        .form-group label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 20px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #4e73df;
        }
    </style>
</head>

<body>
    <?php
    // Include the connection.php file
    require_once '../php_files/connection.php';

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve the form data
        $id = $_POST['name'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $year = $_POST['year'];

        // Prepare and execute the SQL query
        $query = "INSERT INTO tb_student (id, username, password, std_year) VALUES ($id, $username, $password, $year)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssss", $id, $username, $password, $year);
        $stmt->execute();

        // Check if the insertion was successful
        if ($stmt->affected_rows > 0) {
            $message = "Student added successfully.";
        } else {
            $message = "Failed to add student.";
        }

        // Close the statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        // Display the response message
        echo '<div id="popup" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Result</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" id="popupMessage">' . $message . '</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>';

        // Reset the form
        echo '<script>document.getElementById("addStudentForm").reset();</script>';
    }
    ?>

    <div class="container">
        <h2 style="text-align: center; margin-bottom: 30px;">Add Student</h2>
        <form id="addStudentForm" method="POST">
            <div class="form-group">
                <label for="name">ID</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="text" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <input type="text" class="form-control" id="year" name="year" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </form>
    </div>

    <div id="popup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Result</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="popupMessage">
                    <!-- Response message will be displayed here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
