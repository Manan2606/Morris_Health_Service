<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .main-content {
            margin-top: 30px;
        }
        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            color: #343a40; /* Dark color for contrast */
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card-title {
            font-size: 20px;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand mr-auto" href="#">Morris Health Service</a>
        </div>
    </nav>

    <div class="container main-content">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h3 class="card-title">Employee and Facility Management</h3>
                        <button class="btn btn-primary btn-block" onclick="window.location.href='Employee_Facility_Management/employee_facility_management.php'">Explore</button>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h3 class="card-title">Patient Management</h3>
                        <button class="btn btn-primary btn-block" onclick="window.location.href='Patient_Management/patient_management.php'">Explore</button>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h3 class="card-title">Management Reports</h3>
                        <button class="btn btn-primary btn-block" onclick="window.location.href='Management_Reporting/management_reports.php'">Explore</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Include Bootstrap JS -->
    <!-- Include jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- Include Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
