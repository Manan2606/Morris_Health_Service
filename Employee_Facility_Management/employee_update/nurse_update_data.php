<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if(isset($_POST['certification']) && isset($_POST['nurseEmployeeID'])) {
    // Sanitize and get the POST data
    $certification = $_POST['certification'];
    $nurseEmployeeID = $_POST['nurseEmployeeID'];

    // Update the NURSE table
    $update_nurse = "UPDATE NURSE SET Certification = '$certification' WHERE Nurse_Employee_ID = '$nurseEmployeeID'";
    $result_nurse = $con->query($update_nurse);

    // Check if the NURSE table update was successful
    if($result_nurse) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating NURSE data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
