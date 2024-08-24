<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Invoice_ID'], $_POST['Cost'], $_POST['Make_Appointment_ID'])) {

    // Sanitize and get the POST data
    $invoiceID = $_POST['Invoice_ID'];
    $cost = $_POST['Cost'];
    $makeAppointmentID = $_POST['Make_Appointment_ID'];

    // Update the INVOICE_DETAIL table
    $update_invoice_detail = "UPDATE INVOICE_DETAIL SET Cost = '$cost' WHERE Invoice_ID = '$invoiceID' AND Make_Appointment_ID = '$makeAppointmentID'";
    $result_invoice_detail = $con->query($update_invoice_detail);

    if ($result_invoice_detail) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Invoice detail updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating invoice detail: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'Incomplete POST data received';
}

// Send JSON response
echo json_encode($response);
?>
