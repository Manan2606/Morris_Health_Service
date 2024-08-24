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

        <label for="startDate">Please select a start date:</label>
        <input type="date" id="startDate" name="startDate" required>

        <label for="endDate">Please select a end date:</label>
        <input type="date" id="endDate" name="endDate" required>

        <?php
        require_once '../db.php';
        $sql1 = "SELECT DISTINCT speciality FROM doctor";
        $result1 = mysqli_query($con, $sql1);
        ?>

        <select class="form-select" name="specialitySelected" aria-label="Default select example" style="margin: 50px;" required>
            <option selected>Select your physician type</option>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
                $speciality = $row['speciality'];
                echo "<option value='$speciality'>$speciality</option>";
            }
            ?>
        </select>
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
    $speciality = isset($_POST['specialitySelected']) ? $_POST['specialitySelected'] : '';
    $inputPatientID = isset($_POST['inputPatientID']) ? $_POST['inputPatientID'] : '';
    $startDate = isset($_POST['startDate']) ? $_POST['startDate'] : '';
    $endDate = isset($_POST['endDate']) ? $_POST['endDate'] : '';
    
    $sql1 = "SELECT Date_Time, emp.FName as firstName, emp.LName as lastName 
    FROM make_appointment AS ma 
    INNER JOIN (SELECT Doctor_Employee_ID FROM doctor WHERE speciality = '$speciality') AS filtered_doctors 
        ON ma.Doctor_Employee_ID = filtered_doctors.Doctor_Employee_ID
    INNER JOIN employee as emp ON emp.Emp_ID = ma.Doctor_Employee_ID
    WHERE ma.patient_id = '$inputPatientID' AND Date_Time>='$startDate' AND Date_Time<='$endDate';";


    $result1 = mysqli_query($con, $sql1);
    $num_appointments = mysqli_num_rows($result1);

    if ($num_appointments > 0) {
        echo "You have $num_appointments appointments on. ";
        echo '<div style="margin-left: 300px; margin-right:250px;">';
            echo "<h1 class='text-center mb-4'>Your Appointments</h1>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'>
            <tr>
                <th>Date And Time</th>
                <th>Physician First Name</th>
                <th>Physician Last Name</th>
            </tr>
        </thead>";
        while ($row = mysqli_fetch_assoc($result1)) {
            echo "<tr>
            <td>" . $row["Date_Time"] . "</td>
            <td>" . $row["firstName"] . "</td>
            <td>" . $row["lastName"] . "</td>
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