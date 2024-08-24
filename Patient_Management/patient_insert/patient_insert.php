<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 50px;
        }

        .form-container {
            max-width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="form-container">
            <h2>Add Patient</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="FName">First Name:</label>
                    <input type="text" class="form-control" id="FName" name="FName" required>
                </div>
                <div class="form-group">
                    <label for="MInit">Middle Initial:</label>
                    <input type="text" class="form-control" id="MInit" name="MInit">
                </div>
                <div class="form-group">
                    <label for="LName">Last Name:</label>
                    <input type="text" class="form-control" id="LName" name="LName" required>
                </div>
                <div class="form-group">
                    <label for="Doctor_Employee_ID">Doctor Employee ID:</label>
                    <select class="form-control" id="Doctor_Employee_ID" name="Doctor_Employee_ID" required>
                        <option value="">Select Doctor Employee ID</option>
                        <?php

                        require_once '../../db.php'; // Include your database connection file
                        // Retrieve possible Doctor Employee ID values from the DOCTOR table
                        $doctorQuery = "SELECT Doctor_Employee_ID FROM DOCTOR";
                        $doctorResult = $con->query($doctorQuery);
                        while ($row = $doctorResult->fetch_assoc()) {
                            echo '<option value="' . $row['Doctor_Employee_ID'] . '">' . $row['Doctor_Employee_ID'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Insurance_ID">Insurance ID:</label>
                    <select class="form-control" id="Insurance_ID" name="Insurance_ID" required>
                        <option value="">Select Insurance ID</option>
                        <?php

                        require_once '../../db.php'; // Include your database connection file
                        // Retrieve possible Insurance ID values from the INSURANCE_COMPANY table
                        $insuranceQuery = "SELECT Insurance_ID FROM INSURANCE_COMPANY";
                        $insuranceResult = $con->query($insuranceQuery);
                        while ($row = $insuranceResult->fetch_assoc()) {
                            echo '<option value="' . $row['Insurance_ID'] . '">' . $row['Insurance_ID'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Street">Street:</label>
                    <input type="text" class="form-control" id="Street" name="Street">
                </div>
                <div class="form-group">
                    <label for="City">City:</label>
                    <input type="text" class="form-control" id="City" name="City">
                </div>
                <div class="form-group">
                    <label for="State">State:</label>
                    <input type="text" class="form-control" id="State" name="State">
                </div>
                <div class="form-group">
                    <label for="Zip">Zip:</label>
                    <input type="text" class="form-control" id="Zip" name="Zip">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <!-- Back button container -->
    <div class="container-fluid text-center mt-3 back-button-container">
        <a href="../patient_management.php" class="btn btn-secondary">Back</a>
    </div>

    <!-- SweetAlert2 library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <!-- PHP logic for displaying SweetAlert messages -->
    <?php
    require_once '../../db.php'; // Include your database connection file
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fname = $_POST['FName'];
        $minit = $_POST['MInit'];
        $lname = $_POST['LName'];
        $doctorEmployeeID = $_POST['Doctor_Employee_ID'];
        $insuranceID = $_POST['Insurance_ID'];
        $street = $_POST['Street'];
        $city = $_POST['City'];
        $state = $_POST['State'];
        $zip = $_POST['Zip'];

        // SQL query to insert data into PATIENT table
        $sql = "INSERT INTO PATIENT (FName, MInit, LName, Doctor_Employee_ID, Insurance_ID, Street, City, State, Zip) 
                    VALUES ('$fname', '$minit', '$lname', $doctorEmployeeID, $insuranceID, '$street', '$city', '$state', '$zip')";

        if ($con->query($sql) === TRUE) {
            echo '<script>
                        Swal.fire({
                          icon: "success",
                          title: "Success!",
                          text: "New record created successfully"
                        }).then((value) => {
                          window.location.href = "patient_insert.php";
                        });
                      </script>';
        } else {
            echo '<script>
                        Swal.fire({
                          icon: "error",
                          title: "Error!",
                          text: "Error: ' . $sql . '<br>' . $con->error . '"
                        });
                      </script>';
        }


    }
    ?>
</body>

</html>