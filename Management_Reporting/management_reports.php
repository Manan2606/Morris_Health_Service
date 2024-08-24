<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Management Reports</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Management Reports</h2>
        <div class="row mt-3">
            <div class="col-md-4 mb-3">
                <a href="get_report_revenue.php">
                    <button class="btn btn-primary btn-block">Revenue by Facility</button>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="list_appointments_physician.php">
                    <button class="btn btn-primary btn-block">Appointments by Physicians</button>
                </a>
            </div>
            <div class="col-md-4 mb-3">
                <a href="list_appointments_facility.php">
                    <button class="btn btn-primary btn-block">Appointments by Facility</button>
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="best_five_days.php">
                    <button class="btn btn-primary btn-block">5 Best Days</button>
                </a>
            </div>
            <div class="col-md-6 mb-3">
                <a href="avg_inurance_revenue.php">
                    <button class="btn btn-primary btn-block">Average Daily Revenue</button>
                </a>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <a href="../index.php" class="btn btn-secondary">Back</a>
    </div>
</body>
</html>
