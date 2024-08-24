<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Make_Appointment_ID'], $_POST['Doctor_Employee_ID'], $_POST['Patient_ID'], $_POST['Facility_ID'], $_POST['Date_Time'], $_POST['Description'])) {

    // Sanitize and get the POST data
    $appointmentID = $_POST['Make_Appointment_ID'];
    $doctorEmployeeID = $_POST['Doctor_Employee_ID'];
    $patientID = $_POST['Patient_ID'];
    $facilityID = $_POST['Facility_ID'];
    $dateTime = $_POST['Date_Time'];
    $description = $_POST['Description'];

    // Check if the provided doctor employee ID exists in the DOCTOR table
    $check_doctor_query = "SELECT * FROM DOCTOR WHERE Doctor_Employee_ID = '$doctorEmployeeID'";
    $result_check_doctor = $con->query($check_doctor_query);

    if ($result_check_doctor->num_rows > 0) {
        // Get the associated Doctor_Employee_SSN
        $row = $result_check_doctor->fetch_assoc();
        $doctorEmployeeSSN = $row['Doctor_Employee_ID'];

        // Check if the provided patient ID exists in the PATIENT table
        $check_patient_query = "SELECT * FROM PATIENT WHERE Patient_ID = '$patientID'";
        $result_check_patient = $con->query($check_patient_query);

        if ($result_check_patient->num_rows > 0) {

            // Check if the provided facility ID exists in the FACILITY table
            $check_facility_query = "SELECT * FROM FACILITY WHERE Facility_ID = '$facilityID'";
            $result_check_facility = $con->query($check_facility_query);

            if ($result_check_facility->num_rows > 0) {

                // Update the MAKE_APPOINTMENT table
                $update_appointment = "UPDATE MAKE_APPOINTMENT SET Doctor_Employee_ID = '$doctorEmployeeID', Doctor_SSN = '$doctorEmployeeSSN', Patient_ID = '$patientID', Facility_ID = '$facilityID', Date_Time = '$dateTime', Description = '$description' WHERE Make_Appointment_ID = '$appointmentID'";
                $result_appointment = $con->query($update_appointment);

                if ($result_appointment) {
                    // Send a success response
                    $response['status'] = 'success';
                    $response['message'] = 'Appointment updated successfully';
                } else {
                    // Send an error response
                    $response['status'] = 'error';
                    $response['message'] = 'Error updating appointment: ' . $con->error;
                }
            } else {
                // Send an error response if the facility ID doesn't exist
                $response['status'] = 'error';
                $response['message'] = 'Invalid Facility ID';
            }
        } else {
            // Send an error response if the patient ID doesn't exist
            $response['status'] = 'error';
            $response['message'] = 'Invalid Patient ID';
        }
    } else {
        // Send an error response if the doctor employee ID doesn't exist
        $response['status'] = 'error';
        $response['message'] = 'Invalid Doctor Employee ID';
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'Incomplete POST data received';
}

// Send JSON response
echo json_encode($response);
?>
