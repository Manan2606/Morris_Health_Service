<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Patient Management</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Custom CSS for positioning the back button */
        .back-button-container {
            position: fixed;
            bottom: 20px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Patient Management</h2>
        <div class="row mt-3">
            <div class="col-md-6">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-block" type="button" id="insertDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Insert Patient Information
                    </button>
                    <div class="dropdown-menu" aria-labelledby="insertDropdown">
                        <a class="dropdown-item" href="patient_insert/patient_insert.php">Patient</a>
                        <a class="dropdown-item" href="patient_insert/insurance_company_insert.php">Insurance Company</a>
                        <a class="dropdown-item" href="patient_insert/invoice_insert.php">Invoice</a>
                        <a class="dropdown-item" href="patient_insert/invoice_detail_insert.php">Invoice Detail</a>
                        <a class="dropdown-item" href="patient_insert/make_appointment_insert.php">Make Appointment</a>                    
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle btn-block" type="button" id="viewDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        View/Update Patient Information
                    </button>
                    <div class="dropdown-menu" aria-labelledby="viewDropdown">
                        <a class="dropdown-item" href="patient_view_update.php?patient">Patient</a>
                        <a class="dropdown-item" href="patient_view_update.php?insurance_company">Insurance Company</a>
                        <a class="dropdown-item" href="patient_view_update.php?make_appointment">Make Appointment</a>
                        <a class="dropdown-item" href="patient_view_update.php?invoice">Invoice</a>
                        <a class="dropdown-item" href="patient_view_update.php?invoice_detail">Invoice Detail</a>
                        <a class="dropdown-item" href="patient_view_update.php?treats">Treats</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Back button container -->
    <div class="container-fluid text-center mt-3 back-button-container">
        <a href="../index.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Include Popper.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
