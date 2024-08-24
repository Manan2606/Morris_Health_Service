<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Make Appointment</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
        rel="stylesheet">
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
            <h2>Add Make Appointment</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="Date">Date:</label>
                    <input type="date" class="form-control" id="Date" name="Date" required>
                </div>
                <div class="form-group">
                    <label for="Time">Time:</label>
                    <input type="time" class="form-control" id="Time" name="Time" required>
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
                    <label for="Patient_ID">Patient ID:</label>
                    <select class="form-control" id="Patient_ID" name="Patient_ID" required>
                        <option value="">Select Patient ID</option>
                        <?php
                        require_once '../../db.php';
                        // Retrieve possible Patient ID values from the PATIENT table
                        $patientQuery = "SELECT Patient_ID FROM PATIENT";
                        $patientResult = $con->query($patientQuery);
                        while ($row = $patientResult->fetch_assoc()) {
                            echo '<option value="' . $row['Patient_ID'] . '">' . $row['Patient_ID'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Facility_ID">Facility ID:</label>
                    <select class="form-control" id="Facility_ID" name="Facility_ID" required>
                        <option value="">Select Facility ID</option>
                        <?php
                        require_once '../../db.php';
                        // Retrieve possible Facility ID values from the FACILITY table
                        $facilityQuery = "SELECT Facility_ID FROM FACILITY";
                        $facilityResult = $con->query($facilityQuery);
                        while ($row = $facilityResult->fetch_assoc()) {
                            echo '<option value="' . $row['Facility_ID'] . '">' . $row['Facility_ID'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Insurance_ID">Insurance ID:</label>
                    <select class="form-control" id="Insurance_ID" name="Insurance_ID" required>
                        <option value="">Select Insurance ID</option>
                        <?php
                        require_once '../../db.php';
                        // Retrieve possible Insurance ID values from the INSURANCE table
                        $insuranceQuery = "SELECT Insurance_ID FROM INSURANCE_COMPANY";
                        $insuranceResult = $con->query($insuranceQuery);
                        while ($row = $insuranceResult->fetch_assoc()) {
                            echo '<option value="' . $row['Insurance_ID'] . '">' . $row['Insurance_ID'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Description">Description:</label>
                    <textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
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
    <!-- Bootstrap Datepicker library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <!-- Initialize Bootstrap DateTimePicker -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.en.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#Date_Time').datepicker({
                format: 'yyyy-mm-dd hh:ii:ss', // Updated format for datetimepicker
                autoclose: true,
                todayHighlight: true
            });
        });
    </script>

    <!-- PHP logic for displaying SweetAlert messages -->
    <?php
    require_once '../../db.php'; // Include your database connection file
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Date = $_POST['Date'];
        $Time = $_POST['Time'];
        $Doctor_Employee_ID = $_POST['Doctor_Employee_ID'];
        $Patient_ID = $_POST['Patient_ID'];
        $Facility_ID = $_POST['Facility_ID'];
        $Insurance_ID = $_POST['Insurance_ID'];
        $Description = $_POST['Description'];

        // Concatenate date and time into a single string
        $DateTime = $Date . ' ' . $Time;

        // SQL query to insert data into MAKE_APPOINTMENT table
        $sql = "INSERT INTO MAKE_APPOINTMENT (Date_Time, Doctor_Employee_ID, Patient_ID, Facility_ID, Description) 
            VALUES ('$DateTime', '$Doctor_Employee_ID', '$Patient_ID', '$Facility_ID', '$Description')";

        if ($con->query($sql) === TRUE) {
            echo '<script>
                Swal.fire({
                  icon: "success",
                  title: "Success!",
                  text: "New record created successfully"
                }).then((value) => {
                  window.location.href = "make_appointment_insert.php";
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