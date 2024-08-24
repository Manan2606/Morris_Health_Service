<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if(isset($_POST['jobTitle']) && isset($_POST['adminEmployeeID'])) {
    // Sanitize and get the POST data
    $jobTitle = $_POST['jobTitle'];
    $adminEmployeeID = $_POST['adminEmployeeID'];

    // Update the ADMIN table
    $update_admin = "UPDATE ADMIN SET Job_Title = '$jobTitle' WHERE Admin_Employee_ID = '$adminEmployeeID'";
    $result_admin = $con->query($update_admin);

    // Check if the ADMIN table update was successful
    if($result_admin) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating ADMIN data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
