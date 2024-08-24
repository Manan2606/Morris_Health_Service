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

        if (isset($_GET['admin'])) {
            $sql = "SELECT * FROM ADMIN";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>ADMIN Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Admin Employee ID</th>
                        <th>Job Title</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Admin_Employee_ID"] . "</td>
                        <td>" . $row["Job_Title"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"admin\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['other_hcp'])) {
            $sql = "SELECT * FROM OTHER_HCP";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>OTHER HCP Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                    <th>Other HCP Employee ID</th>
                        <th>Job Title</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Other_HCP_Employee_ID"] . "</td>
                        <td>" . $row["Job_Title"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"other_hcp\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['nurse'])) {
            $sql = "SELECT * FROM NURSE";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>NURSE Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                    <th>Nurse Employee ID</th>
                        <th>Certification</th>
                        <th>Actions</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["Nurse_Employee_ID"] . "</td>
                        <td>" . $row["Certification"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"nurse\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['doctor'])) {
            $sql = "SELECT * FROM DOCTOR";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>DOCTOR Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                    <th>Doctor Employee ID</th>
                        <th>Speciality</th>
                        <th>BC Date</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                    <td>" . $row["Doctor_Employee_ID"] . "</td>
                        <td>" . $row["Speciality"] . "</td>
                        <td>" . $row["BC_Date"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"doctor\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['employee'])) {
            $sql = "SELECT * FROM EMPLOYEE";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>Employee Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Emp_ID</th>
                        <th>Emp_SSN</th>
                        <th>FName</th>
                        <th>Minit</th>
                        <th>Lname</th>
                        <th>Facility_ID</th>
                        <th>Salary</th>
                        <th>Hire_Date</th>
                        <th>Job_Class</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>Zip</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Emp_ID"] . "</td>
                        <td>" . $row["Emp_SSN"] . "</td>
                        <td>" . $row["FName"] . "</td>
                        <td>" . $row["Minit"] . "</td>
                        <td>" . $row["Lname"] . "</td>
                        <td>" . $row["Facility_ID"] . "</td>
                        <td>" . $row["Salary"] . "</td>
                        <td>" . $row["Hire_Date"] . "</td>
                        <td>" . $row["Job_Class"] . "</td>
                        <td>" . $row["Street"] . "</td>
                        <td>" . $row["City"] . "</td>
                        <td>" . $row["Zip"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"employee\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
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

    <!-- Back button container -->
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
                case 'admin':
                    $('#updateForm').append('<div class="form-group"><label for="adminEmployeeID">Admin Employee ID</label><input type="text" class="form-control" id="adminEmployeeID" value="' + entityData.Admin_Employee_ID + '" disabled></div><div class="form-group"><label for="jobTitle">Job Title</label><input type="text" class="form-control" id="jobTitle" value="' + entityData.Job_Title + '"></div><div class="form-group">');
                    break;

                case 'nurse':
                    $('#updateForm').append('<div class="form-group"><label for="nurseEmployeeID">Nurse Employee ID</label><input type="text" class="form-control" id="nurseEmployeeID" value="' + entityData.Nurse_Employee_ID + '" disabled></div><div class="form-group"><label for="certification">Certification</label><input type="text" class="form-control" id="certification" value="' + entityData.Certification + '"></div> ');
                    break;

                case 'doctor':
                    $('#updateForm').append('<div class="form-group"><label for="doctorEmployeeID">Doctor Employee ID</label><input type="text" class="form-control" id="Doctor_Employee_ID" value="' + entityData.Doctor_Employee_ID + '" disabled></div><div class="form-group"><label for="speciality">Speciality</label><input type="text" class="form-control" id="speciality" value="' + entityData.Speciality + '"></div><div class="form-group"><label for="bcDate">BC Date</label><input type="text" class="form-control" id="bcDate" value="' + entityData.BC_Date + '"></div> ');
                    break;

                case 'other_hcp':
                    $('#updateForm').append('<div class="form-group"><label for="otherHCPEmployeeID">HCP Employee ID</label><input type="text" class="form-control" id="Other_HCP_Employee_ID" value="' + entityData.Other_HCP_Employee_ID + '" disabled></div><div class="form-group"><label for="jobTitle">Job Title</label><input type="text" class="form-control" id="jobTitle" value="' + entityData.Job_Title + '"></div>');
                    break;

                case 'employee':
                    $('#updateForm').append('<div class="form-group"><label for="empID">Employee ID</label><input type="text" class="form-control" id="Emp_ID" value="' + entityData.Emp_ID + '" disabled></div><div class="form-group"><label for="empSSN">Employee SSN</label><input type="text" class="form-control" id="Emp_SSN" value="' + entityData.Emp_SSN + '"></div><div class="form-group"><label for="fName">First Name</label><input type="text" class="form-control" id="FName" value="' + entityData.FName + '"></div><div class="form-group"><label for="Minit">Middle Initial</label><input type="text" class="form-control" id="Minit" value="' + entityData.Minit + '"></div><div class="form-group"><label for="Lname">Last Name</label><input type="text" class="form-control" id="Lname" value="' + entityData.Lname + '"></div><div class="form-group"><label for="facilityID">Facility ID</label><input type="text" class="form-control" id="Facility_ID" value="' + entityData.Facility_ID + '"></div><div class="form-group"><label for="salary">Salary</label><input type="text" class="form-control" id="Salary" value="' + entityData.Salary + '"></div><div class="form-group"><label for="hireDate">Hire Date</label><input type="text" class="form-control" id="Hire_Date" value="' + entityData.Hire_Date + '"></div><div class="form-group"><label for="jobClass">Job Class</label><input type="text" class="form-control" id="Job_Class" value="' + entityData.Job_Class + '"></div><div class="form-group"><label for="street">Street</label><input type="text" class="form-control" id="Street" value="' + entityData.Street + '"></div><div class="form-group"><label for="city">City</label><input type="text" class="form-control" id="City" value="' + entityData.City + '"></div><div class="form-group"><label for="zip">Zip</label><input type="text" class="form-control" id="Zip" value="' + entityData.Zip + '"></div> ');
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
                url: 'employee_update/' + entityType + '_update_data.php',
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