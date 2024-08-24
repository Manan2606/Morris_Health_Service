<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Facility_ID'])) {

    // Sanitize and get the POST data
    $facilityID = $_POST['Facility_ID'];
    $roomCount = $_POST['Room_Count'];
    $description = $_POST['Description'];
    $pCode = $_POST['P_Code'];

    // Update the OUT_PATIENT_SURGERY table
    $update_out_patient_surgery = "UPDATE OUT_PATIENT_SURGERY SET Room_Count = '$roomCount', Description = '$description', P_Code = '$pCode' WHERE Facility_ID = '$facilityID'";
    $result_out_patient_surgery = $con->query($update_out_patient_surgery);

    if ($result_out_patient_surgery) {
        // Send a success response
        $response['status'] = 'success';
        $response['message'] = 'Data updated successfully';
    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating OUT_PATIENT_SURGERY data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
