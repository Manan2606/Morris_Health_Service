<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Show appointments</title>
</head>

<body>
    <form action="" method="post">
        <div class="input-group mb-3" style="margin: 50px; width: 500px;">
            <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroup-sizing-default">Enter your Patient ID</span>
            </div>
            <input type="text" id="inputPatientID" name="inputPatientID" class="form-control" aria-label="Enter your Patient ID" aria-describedby="inputGroup-sizing-default" required>
        </div>


        <?php
        require_once '../db.php';
        $sql1 = "SELECT DISTINCT Facility_type FROM facility";
        $result1 = mysqli_query($con, $sql1);
        ?>

        <select class="form-select" name="facilitySelected" aria-label="Default select example" style="margin: 50px;" required>
            <option selected>Select your facility type</option>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
                $facilitySelected = $row['Facility_type'];
                echo "<option value='$facilitySelected'>$facilitySelected</option>";
            }
            ?>
        </select>

        <?php
        require_once '../db.php';
        $sql2 = "SELECT Street, City, Zip FROM facility";
        $result2 = mysqli_query($con, $sql2);
        ?>
        <select class="form-select" name="facilityAddress" aria-label="Default select example" style="margin: 50px;" required>
            <option selected>Select your facility address</option>
            <?php
            while ($row = mysqli_fetch_assoc($result2)) {
                $street = $row['Street'];
                $city = $row['City'];
                $zip = $row['Zip'];
                echo "<option value='$street,$city,$zip'>$street, $city, $zip</option>";
            }
            ?>
        </select>

        <label for="startDate">Please select a start date:</label>
        <input type="date" id="startDate" name="startDate" required>

        <label for="endDate">Please select a end date:</label>
        <input type="date" id="endDate" name="endDate" required>
        <button type="submit" class="btn btn-primary">Fetch my appointments</button>
    </form>

    <div class="container mt-3">
        <a href="management_reports.php" class="btn btn-secondary">Back</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    $inputPatientID = isset($_POST['inputPatientID']) ? $_POST['inputPatientID'] : '';
    $facilitySelected = isset($_POST['facilitySelected']) ? $_POST['facilitySelected'] : '';
    $facilityAddress = isset($_POST['facilityAddress']) ? $_POST['facilityAddress'] : '';
    $addressArray = explode(',', $facilityAddress);
    $Street = $addressArray[0];
    $City = $addressArray[1];
    $Zip = $addressArray[2];



    $sql = "SELECT id.Cost, emp.FName as Physician_First_Name, emp.LName as Physician_Last_Name, ma.Date_Time, ma.Description, ma.Make_Appointment_ID, fac.Facility_ID from facility as fac
    JOIN make_appointment as ma ON ma.Facility_ID = fac.Facility_ID
    JOIN employee as emp ON emp.Emp_ID = ma.Doctor_Employee_ID
    JOIN patient as pt ON pt.Patient_ID = ma.Patient_ID
    JOIN invoice_detail as id ON id.Make_Appointment_ID = ma.Make_Appointment_ID
    WHERE fac.Street='$Street' AND fac.City='$City' AND fac.Zip='$Zip' AND ma.Patient_ID='$inputPatientID'
    AND ma.Date_Time>='$startDate' AND ma.Date_Time<='$endDate' AND fac.Facility_Type = '$facilitySelected';";

    $result1 = mysqli_query($con, $sql);
    $num_appointments = mysqli_num_rows($result1);

    if ($num_appointments > 0) {
        echo "You have $num_appointments appointments on. ";
        echo "<h1 class='text-center mb-4'>Your Summary</h1>";
        echo '<div style="margin-left: 300px; margin-right:250px;">';
        echo "<div class='table-responsive'>";
        echo "<table class='table table-striped table-bordered'>";
        echo "<thead class='thead-dark'>
        <tr>
        <th>Appointment ID</th>
        <th>Date & Time</th>
        <th>Facility ID</th>
        <th>Physician First Name</th>
        <th>Physician Last Name</th>
        <th>Description</th>
        <th>Cost</th>
        </tr>
        </thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<tr>
                <td>" . $row["Make_Appointment_ID"] . "</td>
                <td>" . $row["Date_Time"] . "</td>
                <td>" . $row["Facility_ID"] . "</td>
                <td>" . $row["Physician_First_Name"] . "</td>
                <td>" . $row["Physician_Last_Name"] . "</td>
                <td>" . $row["Description"] . "</td>
                <td>" . $row["Cost"] . "</td>
            </tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo '</div>';
    } else {
        echo "No appointments found for you right now :).";
    }
}
?>


</html>