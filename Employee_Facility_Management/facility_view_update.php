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

        if (isset($_GET['facility'])) {
            $sql = "SELECT * FROM FACILITY";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>FACILITY Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Facility ID</th>
                        <th>Street</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Facility Size</th>
                        <th>Facility Type</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Facility_ID"] . "</td>
                        <td>" . $row["Street"] . "</td>
                        <td>" . $row["City"] . "</td>
                        <td>" . $row["State"] . "</td>
                        <td>" . $row["Zip"] . "</td>
                        <td>" . $row["Facility_Size"] . "</td>
                        <td>" . $row["Facility_Type"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"facility\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['office'])) {
            $sql = "SELECT * FROM OFFICE";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>OFFICE Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Facility ID</th>
                        <th>Office Count</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Facility_ID"] . "</td>
                        <td>" . $row["Office_Count"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"office\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
                    </tr>";
                }

                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p class='text-center'>No results found</p>";
            }
        }

        if (isset($_GET['out_patient_surgery'])) {
            $sql = "SELECT * FROM OUT_PATIENT_SURGERY";
            $result = $con->query($sql);

            if ($result->num_rows > 0) {
                echo "<h1 class='text-center mb-4'>OUT PATIENT SURGERY Information</h1>";
                echo "<div class='table-responsive'>";
                echo "<table class='table table-striped table-bordered'>";
                echo "<thead class='thead-dark'>
                    <tr>
                        <th>Facility ID</th>
                        <th>Room Count</th>
                        <th>Description</th>
                        <th>P_Code</th>
                        <th>Action</th>
                    </tr>
                </thead>";
                echo "<tbody>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>" . $row["Facility_ID"] . "</td>
                        <td>" . $row["Room_Count"] . "</td>
                        <td>" . $row["Description"] . "</td>
                        <td>" . $row["P_Code"] . "</td>
                        <td><button class='btn btn-primary' onclick='openUpdateModal(\"out_patient_surgery\", " . json_encode($row) . ")'><i class='fas fa-pencil-alt'></i></button></td>
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

                case 'facility':
                    $('#updateForm').append('<div class="form-group"><label for="facilityID">Facility ID</label><input type="text" class="form-control" id="Facility_ID" value="' + entityData.Facility_ID + '" disabled></div><div class="form-group"><label for="street">Street</label><input type="text" class="form-control" id="Street" value="' + entityData.Street + '"></div><div class="form-group"><label for="city">City</label><input type="text" class="form-control" id="City" value="' + entityData.City + '"></div><div class="form-group"><label for="state">State</label><input type="text" class="form-control" id="State" value="' + entityData.State + '"></div><div class="form-group"><label for="zip">Zip</label><input type="text" class="form-control" id="Zip" value="' + entityData.Zip + '"></div><div class="form-group"><label for="facilitySize">Facility Size</label><input type="text" class="form-control" id="Facility_Size" value="' + entityData.Facility_Size + '"></div><div class="form-group"><label for="facilityType">Facility Type</label><input type="text" class="form-control" id="Facility_Type" value="' + entityData.Facility_Type + '"></div>');
                    break;

                case 'office':
                    $('#updateForm').append('<div class="form-group"><label for="facilityID">Facility ID</label><input type="text" class="form-control" id="Facility_ID" value="' + entityData.Facility_ID + '" disabled></div><div class="form-group"><label for="officeCount">Office Count</label><input type="text" class="form-control" id="Office_Count" value="' + entityData.Office_Count + '"></div>');
                    break;

                case 'out_patient_surgery':
                    $('#updateForm').append('<div class="form-group"><label for="facilityID">Facility ID</label><input type="text" class="form-control" id="Facility_ID" value="' + entityData.Facility_ID + '" disabled></div><div class="form-group"><label for="roomCount">Room Count</label><input type="text" class="form-control" id="Room_Count" value="' + entityData.Room_Count + '"></div><div class="form-group"><label for="description">Description</label><input type="text" class="form-control" id="Description" value="' + entityData.Description + '"></div><div class="form-group"><label for="pCode">P_Code</label><input type="text" class="form-control" id="P_Code" value="' + entityData.P_Code + '"></div>');
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
                url: 'facility_update/' + entityType + '_update_data.php',
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