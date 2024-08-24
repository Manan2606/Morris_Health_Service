<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Patient_ID'])) {

    // Sanitize and get the POST data
    $patientID = $_POST['Patient_ID'];
    $Fname = $_POST['Fname'];
    $Minit = $_POST['Minit'];
    $Lname = $_POST['Lname'];
    $Employee_Name = $_POST['Employee_Name'];
    $insuranceID = $_POST['Insurance_ID'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $state = $_POST['State'];
    $zip = $_POST['Zip'];

    // Check if the provided doctor employee ID exists in the EMPLOYEE table
    $check_employee_query = "SELECT * FROM EMPLOYEE WHERE Fname = '$Employee_Name'";
    $result_check_employee = $con->query($check_employee_query);

    if ($result_check_employee->num_rows > 0) {
        // Get the associated Employee Name
        $row_employee = $result_check_employee->fetch_assoc();
        $doctorEmployeeName = $row_employee['Fname'];

        // Check if the provided insurance ID exists in the INSURANCE_COMPANY table
        $check_insurance_query = "SELECT * FROM INSURANCE_COMPANY WHERE Insurance_ID = '$insuranceID'";
        $result_check_insurance = $con->query($check_insurance_query);

        if ($result_check_insurance->num_rows > 0) {

            $Emp_Name = "SELECT Emp_ID FROM EMPLOYEE WHERE Fname = '$doctorEmployeeName'";
            $query = $con->query($Emp_Name);
            $row_employee = $query->fetch_assoc();
            $doctorEmployeeID = $row_employee['Emp_ID'];
            
            // Update the PATIENT table
            $update_patient = "UPDATE PATIENT SET Fname = '$Fname', Minit = '$Minit', Lname = '$Lname', Doctor_Employee_ID = '$doctorEmployeeID', Insurance_ID = '$insuranceID', Street = '$street', City = '$city', State = '$state', Zip = '$zip' WHERE Patient_ID = '$patientID'";
            $result_patient = $con->query($update_patient);

            if ($result_patient) {
                // Send a success response
                $response['status'] = 'success';
                $response['message'] = 'Data updated successfully';
            } else {
                // Send an error response
                $response['status'] = 'error';
                $response['message'] = 'Error updating PATIENT data: ' . $con->error;
            }
        } else {
            // Send an error response if the insurance ID doesn't exist
            $response['status'] = 'error';
            $response['message'] = 'Invalid Insurance ID';
        }
    } else {
        // Send an error response if the doctor employee ID doesn't exist
        $response['status'] = 'error';
        $response['message'] = 'Invalid Doctor Employee ID';
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);
?>
