<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Get revenue report</title>
</head>

<body>

    <div class="container" style="margin: 50px;">
        <div class="row">
            <div class="col">
                <form method="post">
                    <label for="inputDate">Please select a date for which to generate report:</label>
                    <input type="date" id="inputDate" name="inputDate" required>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">Get Summary</button>
                </form>
            </div>
        </div>
    </div>


    <?php
    require_once '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $inputDate = $_POST['inputDate'];

        $sql1 = "SELECT id.Make_Appointment_ID, id.Cost, ma.Doctor_Employee_ID, ma.Patient_ID, dr.FName AS DoctorFirstName, dr.LName AS DoctorLastName, pt.FName AS PatientFirstName, pt.LName AS PatientLastName
        FROM invoice_detail AS id
        JOIN invoice AS inv ON id.Invoice_ID = inv.Invoice_ID 
        JOIN make_appointment AS ma ON ma.Make_Appointment_ID = id.Make_Appointment_ID
        JOIN employee AS dr ON dr.Emp_ID = ma.Doctor_Employee_ID
        JOIN patient AS pt ON pt.Patient_ID = ma.Patient_ID
        WHERE inv.Invoice_Date = '$inputDate';";
        $result1 = mysqli_query($con, $sql1);

        if ($result1->num_rows == 0) {
            echo '<div style="margin-left: 500px;">';
            echo '<h3>There were no appointments for this day</h3>';
            echo '</div>';
        } else {
            $totalCost = 0;
            $numPatients = 0;
            echo '<div style="margin-left: 300px; margin-right:250px;">';
            echo "<h1 class='text-center mb-4'>Your Summary</h1>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'>
            <tr>
                <th>Appointment ID</th>
                <th>Patient Name</th>
                <th>Doctor Name</th>
                <th>Cost</th>
            </tr>
        </thead>";
            echo "<tbody>";
            while ($row = mysqli_fetch_assoc($result1)) {
                $numPatients = $numPatients + 1;
                $totalCost = $totalCost + $row["Cost"];
                $doctorName = $row["DoctorFirstName"] . " " . $row["DoctorLastName"];
                $patientName = $row["PatientFirstName"] . " " . $row["PatientLastName"];

                echo "<tr>
                <td>" . $row["Make_Appointment_ID"] . "</td>
                <td>" . $patientName . "</td>
                <td>" . $doctorName . "</td>
                <td>" . $row["Cost"] . "</td>
            </tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo '</div>';

            echo "<div class='text-center mt-4'>";
            echo "<p>Number of Patients: " . $numPatients . "</p>";
            echo "<p>Total Cost: $" . $totalCost . "</p>";
            echo "</div>";
        }
    }
    ?>

    <div class="container mt-3">
        <a href="management_reports.php" class="btn btn-secondary">Back</a>
    </div>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>