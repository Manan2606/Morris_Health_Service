<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin Registration</title>
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
        <h1 class="text-center">Admin Registration</h1>
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
                <label for="jobTitle">Job Title</label>
                <input type="text" class="form-control" id="jobTitle" name="jobTitle" required>
            </div>
            <div class="form-row">
                <div class="col-md-6">
                    <label for="date_of_hiring">Date of Hiring</label>
                    <input type="date" id="date_of_hiring" name="date_of_hiring" class="form-control" required>
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
    $jobTitle = $_POST['jobTitle'];

    // Check if SSN already exists
    $sql1 = "SELECT * FROM employee WHERE Emp_SSN = ?";
    $stmt1 = $con->prepare($sql1);
    $stmt1->bind_param("s", $inputSSN);
    $stmt1->execute();
    $result1 = $stmt1->get_result();

    // Check if Facility ID exists
    $sql3 = "SELECT Facility_ID FROM facility WHERE Facility_ID = ?";
    $stmt3 = $con->prepare($sql3);
    $stmt3->bind_param("s", $facilityID);
    $stmt3->execute();
    $result3 = $stmt3->get_result();

    if ($result1->num_rows > 0) {
        echo '<script>alert("This SSN already exists")</script>';
        return false;
    }
    if ($result3->num_rows == 0) {
        echo '<script>alert("Please Enter valid Facility ID")</script>';
        return false;
    } else {
        // Insert employee data
        $sql2 = "INSERT INTO employee (Emp_SSN, FName, MInit, LName, Facility_ID, Salary, Hire_date, Job_Class, Street, City, Zip)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = $con->prepare($sql2);
        $stmt2->bind_param("ssssissssss", $inputSSN, $firstName, $middleInitial, $lastName, $facilityID, $salary, $date_of_hiring, $jobClass, $inputAddress, $inputCity, $inputZip);
        $stmt2->execute();

        // Get the Employee ID of the newly inserted employee
        $Admin_Employee_ID = $con->insert_id;

        // Insert nurse data
        $sql4 = "INSERT INTO admin (Admin_Employee_ID, Job_Title)
             VALUES (?, ?)";
        $stmt4 = $con->prepare($sql4);
        $stmt4->bind_param("is", $Admin_Employee_ID, $jobTitle);
        $stmt4->execute();

        if ($stmt2->affected_rows > 0 && $stmt4->affected_rows > 0) {
            echo '<script>alert("Admin data inserted successfully!")</script>';
        } else {
            echo '<script>alert("Error inserting data: ' . $con->error . '")</script>';
        }
    }
}
?>


</html>