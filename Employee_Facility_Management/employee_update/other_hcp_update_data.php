<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if(isset($_POST['jobTitle']) && isset($_POST['Other_HCP_Employee_ID'])) {
    // Sanitize and get the POST data
    $jobTitle = $_POST['jobTitle'];
    $Other_Hcp_Employee_ID = $_POST['Other_HCP_Employee_ID'];

    // Update the ADMIN table
    $update_hcp = "UPDATE OTHER_HCP SET Job_Title = '$jobTitle' WHERE Other_HCP_Employee_ID = '$Other_Hcp_Employee_ID'";
    $result_hcp = $con->query($update_hcp);

    // Check if the ADMIN table update was successful
    if($result_hcp) {
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
