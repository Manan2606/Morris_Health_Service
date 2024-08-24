<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Doctor_Employee_ID'], $_POST['Patient_ID'])) {

    // Sanitize and get the POST data
    $doctorEmployeeID = $_POST['Doctor_Employee_ID'];
    $patientID = $_POST['Patient_ID'];

    // Check if the combination of Doctor_Employee_ID and Patient_ID already exists
    $check_query = "SELECT * FROM TREATS WHERE Doctor_Employee_ID = '$doctorEmployeeID' AND Patient_ID = '$patientID'";
    $result_check = $con->query($check_query);

    if ($result_check->num_rows > 0) {
        // If the combination already exists, send a response indicating the error
        $response['status'] = 'error';
        $response['message'] = 'The combination of Doctor Employee ID and Patient ID already exists';
    } else {
        // Insert into the TREATS table
        $insert_treats = "INSERT INTO TREATS (Doctor_Employee_ID, Patient_ID) VALUES ('$doctorEmployeeID', '$patientID')";
        $result_insert = $con->query($insert_treats);

        if ($result_insert) {
            // Send a success response
            $response['status'] = 'success';
            $response['message'] = 'Treats information inserted successfully';
        } else {
            // Send an error response
            $response['status'] = 'error';
            $response['message'] = 'Error inserting treats information: ' . $con->error;
        }
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'Incomplete POST data received';
}

// Send JSON response
echo json_encode($response);
?>
