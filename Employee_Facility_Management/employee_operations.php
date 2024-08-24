<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Employee Operations</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Employee Operations</h2>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Insert Employee
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="employee_insert/employee_insert.php">Employee</a>
                        <a class="dropdown-item" href="employee_insert/admin_insert.php">Admin</a>
                        <a class="dropdown-item" href="employee_insert/doctor_insert.php">Doctor</a>
                        <a class="dropdown-item" href="employee_insert/nurse_insert.php">Nurse</a>
                        <a class="dropdown-item" href="employee_insert/other_hcp_insert.php">Other HCP</a>
                    </div>
                </div>
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        View/Update Employee
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="employee_view_update.php?employee">Employee</a>
                        <a class="dropdown-item" href="employee_view_update.php?admin">Admin</a>
                        <a class="dropdown-item" href="employee_view_update.php?nurse">Nurse</a>
                        <a class="dropdown-item" href="employee_view_update.php?doctor">Doctor</a>
                        <a class="dropdown-item" href="employee_view_update.php?other_hcp">Other HCP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back button container -->
    <div class="container-fluid fixed-bottom text-center mb-3">
        <a href="employee_facility_management.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>