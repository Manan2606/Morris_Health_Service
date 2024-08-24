<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.css">
</head>

<body>
    <div class="container mt-5">
        <?php
        require_once '../db.php';

        if (isset($_GET['insurance_company'])) {
            $sql = "SELECT * FROM INSURANCE_COMPANY";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>INSURANCE COMPANY Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Insurance ID</th>
                        <th>Name</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Insurance_ID"] . "</td>
                        <td>" . $row["Name"] . "</td>
                        <td>" . $row["Street"] . "</td>
                        <td>" . $row["City"] . "</td>
                        <td>" . $row["State"] . "</td>
                        <td>" . $row["Zip"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"insurance_company\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['patient'])) {
            $sql = "SELECT PATIENT.*,EMPLOYEE.Fname as Employee_Name FROM PATIENT INNER JOIN DOCTOR ON DOCTOR.Doctor_Employee_ID = PATIENT.Doctor_Employee_ID INNER JOIN EMPLOYEE ON EMPLOYEE.Emp_ID = DOCTOR.Doctor_Employee_ID";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>PATIENT Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Patient ID</th>
                        <th>First Name</th>
                        <th>Middle Intial</th>
                        <th>Last Name</th>
                        <th>Doctor Name</th>
                        <th>Insurance ID</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Patient_ID"] . "</td>
                        <td>" . $row["Fname"] . "</td>
                        <td>" . $row["Minit"] . "</td>
                        <td>" . $row["Lname"] . "</td>
                        <td>" . $row["Employee_Name"] . "</td>
                        <td>" . $row["Insurance_ID"] . "</td>
                        <td>" . $row["Street"] . "</td>
                        <td>" . $row["City"] . "</td>
                        <td>" . $row["State"] . "</td>
                        <td>" . $row["Zip"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"patient\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['treats'])) {
            $sql = "SELECT * FROM TREATS";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>TREATS Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Doctor ID/</th>
                        <th>Patient ID</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Doctor_Employee_ID"] . "</td>
                        <td>" . $row["Patient_ID"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"treats\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>

                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['invoice'])) {
            $sql = "SELECT * FROM INVOICE";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>INVOICE Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Invoice Date</th>
                        <th>Insurance ID</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Invoice_ID"] . "</td>
                        <td>" . $row["Invoice_Date"] . "</td>
                        <td>" . $row["Insurance_ID"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"invoice\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['make_appointment'])) {
            $sql = "SELECT * FROM MAKE_APPOINTMENT";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>MAKE APPOINTMENT Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Make Appointment ID</th>
                        <th>Doctor Employee ID</th>
                        <th>Patient ID</th>
                        <th>Facility ID</th>
                        <th>Date Time</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Make_Appointment_ID"] . "</td> 
                        <td>" . $row["Doctor_Employee_ID"] . "</td> 
                        <td>" . $row["Patient_ID"] . "</td>
                        <td>" . $row["Facility_ID"] . "</td>
                        <td>" . $row["Date_Time"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"make_appointment\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['invoice_detail'])) {
            $sql = "SELECT * FROM INVOICE_DETAIL";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>INVOICE DETAIL Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Invoice ID</th>
                        <th>Cost</th>
                        <th>Appointment ID</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Invoice_ID"] . "</td>
                        <td>" . $row["Cost"] . "</td>
                        <td>" . $row["Make_Appointment_ID"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"invoice_detail\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        ?>

        <!-- Model Start -->
        <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="updateModalLabel">Update Information</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="updateForm">
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="saveChanges()">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Model End -->

    </div>

    <div class="container-fluid fixed-bottom text-center mb-3">
        <a href="javascript:history.go(-1)" class="btn btn-secondary">Back</a>
    </div>

    <script>
        function openUpdateModal(entityType, entityData) {
            // Clear previous modal content
            $('#updateForm').empty();

            // Set modal title based on entity type
            $('#updateModalLabel').text('Update ' + entityType + ' Information');

            // Populate form fields dynamically based on entity type
            switch (entityType) {

                case 'insurance_company':
                    $('#updateForm').append('<div class="form-group"><label for="insuranceID">Insurance ID</label><input type="text" class="form-control" id="Insurance_ID" value="' + entityData.Insurance_ID + '" disabled></div><div class="form-group"><label for="name">Name</label><input type="text" class="form-control" id="Name" value="' + entityData.Name + '"></div><div class="form-group"><label for="street">Street</label><input type="text" class="form-control" id="Street" value="' + entityData.Street + '"></div><div class="form-group"><label for="city">City</label><input type="text" class="form-control" id="City" value="' + entityData.City + '"></div><div class="form-group"><label for="state">State</label><input type="text" class="form-control" id="State" value="' + entityData.State + '"></div><div class="form-group"><label for="zip">Zip</label><input type="text" class="form-control" id="Zip" value="' + entityData.Zip + '"></div>');
                    break;

                case 'patient':
                    $('#updateForm').append('<div class="form-group"><label for="patientID">Patient ID</label><input type="text" class="form-control" id="Patient_ID" value="' + entityData.Patient_ID + '" disabled></div><div class="form-group"><label for="Fname">First Name</label><input type="text" class="form-control" id="Fname" value="' + entityData.Fname + '"></div><div class="form-group"><label for="Minit">Middle Initial</label><input type="text" class="form-control" id="Minit" value="' + entityData.Minit + '"></div><div class="form-group"><label for="Lname">Last Name</label><input type="text" class="form-control" id="Lname" value="' + entityData.Lname + '"></div><div class="form-group"><label for="doctorEmployeeName">Employee Name</label><input type="text" class="form-control" id="Employee_Name" value="' + entityData.Employee_Name + '" ></div><div class="form-group"><label for="insuranceID">Insurance ID</label><input type="text" class="form-control" id="Insurance_ID" value="' + entityData.Insurance_ID + '"></div><div class="form-group"><label for="street">Street</label><input type="text" class="form-control" id="Street" value="' + entityData.Street + '"></div><div class="form-group"><label for="city">City</label><input type="text" class="form-control" id="City" value="' + entityData.City + '"></div><div class="form-group"><label for="state">State</label><input type="text" class="form-control" id="State" value="' + entityData.State + '"></div><div class="form-group"><label for="zip">Zip</label><input type="text" class="form-control" id="Zip" value="' + entityData.Zip + '"></div>');
                    break;

                case 'invoice':
                    $('#updateForm').append('<div class="form-group"><label for="invoiceID">Invoice ID</label><input type="text" class="form-control" id="Invoice_ID" value="' + entityData.Invoice_ID + '" disabled></div><div class="form-group"><label for="invoiceDate">Invoice Date</label><input type="text" class="form-control" id="Invoice_Date" value="' + entityData.Invoice_Date + '"></div><div class="form-group"><label for="insuranceID">Insurance ID</label><input type="text" class="form-control" id="Insurance_ID" value="' + entityData.Insurance_ID + '"></div>');
                    break;

                case 'make_appointment':
                    $('#updateForm').append('<div class="form-group"><label for="makeAppointmentID">Make Appointment ID</label><input type="text" class="form-control" id="Make_Appointment_ID" value="' + entityData.Make_Appointment_ID + '" disabled></div><div class="form-group"><label for="doctorEmployeeID">Doctor Employee ID</label><input type="text" class="form-control" id="Doctor_Employee_ID" value="' + entityData.Doctor_Employee_ID + '"></div><div class="form-group"><label for="patientID">Patient ID</label><input type="text" class="form-control" id="Patient_ID" value="' + entityData.Patient_ID + '"></div><div class="form-group"><label for="facilityID">Facility ID</label><input type="text" class="form-control" id="Facility_ID" value="' + entityData.Facility_ID + '"></div><div class="form-group"><label for="dateTime">Date Time</label><input type="text" class="form-control" id="Date_Time" value="' + entityData.Date_Time + '"></div><div class="form-group"><label for="description">Description</label><input type="text" class="form-control" id="Description" value="' + entityData.Description + '"></div>');
                    break;

                case 'invoice_detail':
                    $('#updateForm').append('<div class="form-group"><label for="invoiceID">Invoice ID</label><input type="text" class="form-control" id="Invoice_ID" value="' + entityData.Invoice_ID + '" disabled></div><div class="form-group"><label for="cost">Cost</label><input type="text" class="form-control" id="Cost" value="' + entityData.Cost + '"></div><div class="form-group"><label for="makeAppointmentID">Make Appointment ID</label><input type="text" class="form-control" id="Make_Appointment_ID" value="' + entityData.Make_Appointment_ID + '" disabled></div>');
                    break;

                case 'treats':
                    $('#updateForm').append('<div class="form-group"><label for="treatsID">Treats ID</label><input type="text" class="form-control" id="Treats_ID" value="' + entityData.Treats_ID + '" disabled></div><div class="form-group"><label for="doctorEmployeeID">Doctor Employee ID</label><input type="text" class="form-control" id="Doctor_Employee_ID" value="' + entityData.Doctor_Employee_ID + '"></div><div class="form-group"><label for="patientID">Patient ID</label><input type="text" class="form-control" id="Patient_ID" value="' + entityData.Patient_ID + '"></div>');
                    break;


                // Add cases for other entity types as needed
                default:
                    break;
            }

            // Show the modal
            $('#updateModal').modal('show');
        }

        function saveChanges() {
            // Get form data
            var entityType = $('#updateModalLabel').text().split(' ')[1].toLowerCase();
            var formData = {};
            $('#updateForm input').each(function () {
                formData[$(this).attr('id')] = $(this).val();
            });

            // Perform AJAX request to update data in the database
            $.ajax({
                type: 'POST',
                url: 'patient_update/' + entityType + '_update_data.php',
                data: formData,
                success: function (response) {
                    // Parse JSON response
                    var responseData = JSON.parse(response);

                    // Check status and show appropriate message
                    if (responseData.status === 'success') {
                        // Show success message using SweetAlert
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: responseData.message,
                            showConfirmButton: false,
                            timer: 2000 // Adjust timing here
                        });

                        // Reload the page after successful update
                        setTimeout(function () {
                            location.reload();
                        }, 2000); // Adjust timing here
                    } else {
                        // Show error message using SweetAlert
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: responseData.message
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle error response
                    console.error('Error updating data:', error);

                    // Show error message using SweetAlert
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while updating data'
                    });
                }
            });
        }
    </script>

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- SweetAlert script -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
</body>

</html>