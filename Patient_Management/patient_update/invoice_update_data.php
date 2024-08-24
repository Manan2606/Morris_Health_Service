<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Invoice_ID'], $_POST['Invoice_Date'], $_POST['Insurance_ID'])) {

    // Sanitize and get the POST data
    $invoiceID = $_POST['Invoice_ID'];
    $invoiceDate = $_POST['Invoice_Date'];
    $insuranceID = $_POST['Insurance_ID'];

    // Check if the provided insurance ID exists in the INSURANCE_COMPANY table
    $check_insurance_query = "SELECT * FROM INSURANCE_COMPANY WHERE Insurance_ID = '$insuranceID'";
    $result_check_insurance = $con->query($check_insurance_query);

    if ($result_check_insurance->num_rows > 0) {
        // Update the INVOICE table
        $update_invoice = "UPDATE INVOICE SET Invoice_Date = '$invoiceDate', Insurance_ID = '$insuranceID' WHERE Invoice_ID = '$invoiceID'";
        $result_invoice = $con->query($update_invoice);

        if ($result_invoice) {
            // Send a success response
            $response['status'] = 'success';
            $response['message'] = 'Data updated successfully';
        } else {
            // Send an error response
            $response['status'] = 'error';
            $response['message'] = 'Error updating INVOICE data: ' . $con->error;
        }
    } else {
        // Send an error response if the insurance ID doesn't exist
        $response['status'] = 'error';
        $response['message'] = 'Invalid Insurance ID';
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'Incomplete POST data received';
}

// Send JSON response
echo json_encode($response);
?>
