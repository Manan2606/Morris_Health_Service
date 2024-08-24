<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Registration</title>
</head>

<body>
    <h1 style="text-align: center;">Enter your details to get registered as an Employee</h1>
    <form style="margin: 40px;" method="post">
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
                <input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last name" required>
            </div>
        </div>
        <div class="form-group">
            <label for="inputSSN">SSN</label>
            <input class="form-control" id="inputSSN" name="inputSSN" placeholder="Enter SSN" minlength="11"
                maxlength="11" required>
        </div>
        <div class="form-group" style="margin-top: 15px;">
            <label for="facilityID">Facility ID</label>
            <input class="form-control" id="facilityID" name="facilityID"
                placeholder="Enter FACILITY ID you are enrolled to" required>
        </div>
        <div class="form-group col-md-4">
            <label for="jobClass">Job Class</label>
            <input type="text" class="form-control" id="jobClass" name="jobClass" required>
        </div>
        <div data-mdb-input-init class="form-outline" style="width: 22rem;">
            <label class="form-label" for="salary">Enter your salary</label>
            <input id="salary" type="number" id="salary" name="salary" class="form-control" required />
        </div>
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St"
                required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState" name="inputState" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="number" class="form-control" id="inputZip" name="inputZip" required maxlength="6">
            </div>
            <label for="birthday">Select your date of hiring:</label>
            <input type="date" id="date_of_hiring" name="date_of_hiring" required>
        </div>
        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>

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

    $firstName = isset($_POST['firstName']) ? $_POST['firstName'] : '';
    $middleInitial = isset($_POST['middleInitial']) ? $_POST['middleInitial'] : '';
    $lastName = isset($_POST['lastName']) ? $_POST['lastName'] : '';
    $inputSSN = $_POST['inputSSN'];
    $facilityID = $_POST['facilityID'];
    $salary = $_POST['salary'];
    $inputAddress = $_POST['inputAddress'];
    $inputCity = $_POST['inputCity'];
    $inputState = $_POST['inputState'];
    $inputZip = $_POST['inputZip'];
    $jobClass = $_POST['jobClass'];
    $date_of_hiring = $_POST['date_of_hiring'];


    $sql1 = "SELECT * FROM employee WHERE Emp_SSN = '$inputSSN'";
    $result1 = $con->query($sql1);

    $sql3 = "SELECT Facility_ID FROM facility WHERE Facility_ID = '$facilityID'";
    $result3 = $con->query($sql3);

    if ($result1->num_rows > 0) {
        echo '<script>alert("This SSN already exists")</script>';
    }
    if ($result3->num_rows == 0) {
        echo '<script>alert("Please Enter valid Facility ID")</script>';
    } else {
        $sql2 = "INSERT INTO employee (Emp_SSN, FName, MInit, LName, Facility_ID, Salary, Hire_date, Job_Class, Street, City, Zip)
    VALUES ('$inputSSN', '$firstName', '$middleInitial', '$lastName', '$facilityID', '$salary', '$date_of_hiring', '$jobClass', '$inputAddress', '$inputCity', '$inputZip');";
        $result2 = $con->prepare($sql2);
        if ($result2->execute()) {
            echo '<script>alert("Employee data inserted successfully!")</script>';
        }
    }
}
?>