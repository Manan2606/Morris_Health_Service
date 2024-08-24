<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Insurance_ID'])) {

    // Sanitize and get the POST data
    $insuranceID = $_POST['Insurance_ID'];
    $name = $_POST['Name'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];

    // Update the INSURANCE_COMPANY table
    $update_insurance_company = "UPDATE INSURANCE_COMPANY SET Name = '$name', Street = '$street', City = '$city', State = '$state', Zip = '$zip' WHERE Insurance_ID = '$insuranceID'";
    $result_insurance_company = $con->query($update_insurance_company);

    if ($result_insurance_company) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating INSURANCE_COMPANY data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
