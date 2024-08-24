<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Facility_ID']) && isset($_POST['Office_Count'])) {

    // Sanitize and get the POST data
    $facilityID = $_POST['Facility_ID'];
    $officeCount = $_POST['Office_Count'];

    // Update the OFFICE table
    $update_office = "UPDATE OFFICE SET Office_Count = '$officeCount' WHERE Facility_ID = '$facilityID'";
    $result_office = $con->query($update_office);

    // Check if the OFFICE table update was successful
    if ($result_office) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating OFFICE data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
