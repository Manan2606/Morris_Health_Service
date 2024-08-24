<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if(isset($_POST['speciality']) && isset($_POST['bcDate']) && isset($_POST['Doctor_Employee_ID'])) {
    // Sanitize and get the POST data
    $speciality = $_POST['speciality'];
    $bcDate = $_POST['bcDate'];
    $Doctor_Employee_ID = $_POST['Doctor_Employee_ID'];

    // Update the DOCTOR table
    $update_doctor = "UPDATE DOCTOR SET Speciality = '$speciality', BC_Date = '$bcDate' WHERE Doctor_Employee_ID = '$Doctor_Employee_ID'";
    $result_doctor = $con->query($update_doctor);

    // Check if the DOCTOR table update was successful
    if($result_doctor) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating DOCTOR data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
