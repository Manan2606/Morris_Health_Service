<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Doctor Registration</title>
    <style>
        body {
            padding-top: 50px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-row {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Doctor Registration</h1>
        <form method="post">
            <div class="row">
                <div class="col" style="margin-top: 15px;">
                    <input type="text" id="firstName" name="firstName" class="form-control" placeholder="First name"
                        required>
                </div>
                <div class="col" style="margin-top: 15px;">
                    <input type="text" id="middleInitial" name="middleInitial" class="form-control"
                        placeholder="Middle Initial">
                </div>
                <div class="col" style="margin-top: 15px;">
                    <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name"
                        required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputSSN">SSN</label>
                <input class="form-control" id="inputSSN" name="inputSSN" placeholder="Enter SSN" minlength="11"
                    maxlength="11" required>
            </div>
            <div class="form-group">
                <label for="facilityID">Facility ID</label>
                <input class="form-control" id="facilityID" name="facilityID" placeholder="Enter Facility ID" required>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <label for="jobClass">Job Class</label>
                    <input type="text" class="form-control" id="jobClass" name="jobClass" required>
                </div>
                <div class="col-md-6">
                    <label for="salary">Salary</label>
                    <input id="salary" type="number" name="salary" class="form-control" required />
                </div>
            </div>
            <div class="form-group">
                <label for="inputAddress">Address</label>
                <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St"
                    required>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <label for="inputCity">City</label>
                    <input type="text" class="form-control" id="inputCity" name="inputCity" required>
                </div>
                <div class="col-md-4">
                    <label for="inputState">State</label>
                    <input type="text" class="form-control" id="inputState" name="inputState" required>
                </div>
                <div class="col-md-4">
                    <label for="inputZip">Zip</label>
                    <input type="number" class="form-control" id="inputZip" name="inputZip" required maxlength="6">
                </div>
            </div>
            <div class="form-group">
                <label for="specialization">Specialization</label>
                <input type="text" class="form-control" id="specialization" name="specialization" required>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <label for="date_of_hiring">Date of Hiring</label>
                    <input type="date" id="date_of_hiring" name="date_of_hiring" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="bc_date">BC Date</label>
                    <input type="date" id="bc_date" name="bc_date" class="form-control" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Back button container -->
    <div class="container-fluid fixed-bottom text-center mb-3">
        <a href="../employee_operations.php" class="btn btn-secondary">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>


<?php

require_once '../../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize input
    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $middleInitial = isset($_POST['middleInitial']) ? $_POST['middleInitial'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $inputSSN = mysqli_real_escape_string($con, $_POST['inputSSN']);
    $facilityID = mysqli_real_escape_string($con, $_POST['facilityID']);
    $salary = mysqli_real_escape_string($con, $_POST['salary']);
    $inputAddress = mysqli_real_escape_string($con, $_POST['inputAddress']);
    $inputCity = mysqli_real_escape_string($con, $_POST['inputCity']);
    $inputState = mysqli_real_escape_string($con, $_POST['inputState']);
    $inputZip = mysqli_real_escape_string($con, $_POST['inputZip']);
    $jobClass = mysqli_real_escape_string($con, $_POST['jobClass']);
    $date_of_hiring = mysqli_real_escape_string($con, $_POST['date_of_hiring']);
    $specialization = mysqli_real_escape_string($con, $_POST['specialization']);
    $bc_date = mysqli_real_escape_string($con, $_POST['bc_date']);

    // Check if SSN already exists
    $sql1 = "SELECT * FROM employee WHERE Emp_SSN = '$inputSSN'";
    $result1 = $con->query($sql1);
    if ($result1->num_rows > 0) {
        echo '<script>alert("This SSN already exists")</script>';
        return false;
    }

    // Check if Facility ID exists
    $sql3 = "SELECT Facility_ID FROM facility WHERE Facility_ID = '$facilityID'";
    $result3 = $con->query($sql3);
    if ($result3->num_rows == 0) {
        echo '<script>alert("Please enter a valid Facility ID")</script>';
        return false;
    }

    // Insert employee data
    $sql2 = "INSERT INTO employee (Emp_SSN, FName, MInit, LName, Facility_ID, Salary, Hire_date, Job_Class, Street, City, Zip)
            VALUES ('$inputSSN', '$firstName', '$middleInitial', '$lastName', '$facilityID', '$salary', '$date_of_hiring', '$jobClass', '$inputAddress', '$inputCity', '$inputZip')";
    $result2 = $con->query($sql2);

    // Retrieve the Employee ID of the newly inserted employee
    $Doctor_Employee_ID = $con->insert_id;

    // Insert doctor data
    $sql4 = "INSERT INTO doctor (Doctor_Employee_ID, Speciality, BC_Date)
            VALUES ('$Doctor_Employee_ID', '$specialization', '$bc_date')";
    $result4 = $con->query($sql4);

    // Check if both inserts were successful
    if ($result2 && $result4) {
        echo '<script>alert("Doctor data inserted successfully!")</script>';
    } else {
        echo '<script>alert("Error inserting data: ' . mysqli_error($con) . '")</script>';
    }
}
?>



</html>