<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Facility_ID'])) {

    // Sanitize and get the POST data
    $facilityID = $_POST['Facility_ID'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];
    $facilitySize = $_POST['Facility_Size'];
    $facilityType = $_POST['Facility_Type'];

    // Update the FACILITY table
    $update_facility = "UPDATE FACILITY SET Street = '$street', City = '$city', State = '$state', Zip = '$zip', Facility_Size = '$facilitySize', Facility_Type = '$facilityType' WHERE Facility_ID = '$facilityID'";
    $result_facility = $con->query($update_facility);

    if ($result_facility) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating FACILITY data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
