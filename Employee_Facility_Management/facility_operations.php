<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Facility Operations</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2>Facility Operations</h2>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        Insert Facility
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="facility_insert/facility_insert.php">Facility</a>
                    <a class="dropdown-item" href="facility_insert/office_insert.php">Office Insert</a>
                    <a class="dropdown-item" href="facility_insert/out_patient_surgery_insert.php">Out Patient Surgery</a>
                        <!-- <a class="dropdown-item" href="#">Insert Facility Information</a> -->
                    </div>
                </div>
                <div class="btn-group mb-3">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        View/Update Facility
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="facility_view_update.php?facility">Facility</a>
                        <a class="dropdown-item" href="facility_view_update.php?office">Office</a>
                        <a class="dropdown-item" href="facility_view_update.php?out_patient_surgery">Out Patient Surgery</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <a href="employee_facility_management.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- Include jQuery first -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Then include Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

    <!-- Finally, include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>