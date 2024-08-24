<?php
require_once '../../db.php'; // Include your database connection file

// Check if the POST data is set
if (isset($_POST['Emp_ID'])) {

    // Sanitize and get the POST data
    $empID = $_POST['Emp_ID'];
    $empSSN = $_POST['Emp_SSN'];
    $fName = $_POST['FName'];
    $mInit = $_POST['MInit'];
    $lName = $_POST['LName'];
    $facilityID = $_POST['Facility_ID'];
    $salary = $_POST['Salary'];
    $hireDate = $_POST['Hire_Date'];
    $jobClass = $_POST['Job_Class'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $zip = $_POST['Zip'];

    // Check if the provided Facility_ID exists in the FACILITY table
    $facilityCheckQuery = "SELECT * FROM FACILITY WHERE Facility_ID = '$facilityID'";
    $facilityCheckResult = $con->query($facilityCheckQuery);

    if ($facilityCheckResult->num_rows === 0) {
        // Facility_ID does not exist in the FACILITY table, show error message
        $response['status'] = 'error';
        $response['message'] = 'Invalid Facility ID. Please select a valid Facility.';
        echo json_encode($response);
        exit; // Stop further execution
    }

    // Existing Facility_ID, proceed with updating the EMPLOYEE table
    $sql2 = "SELECT Emp_SSN FROM EMPLOYEE WHERE Emp_ID = '$empID'";
    $result2 = $con->query($sql2);

    if ($result2->num_rows > 0) {
        $row = $result2->fetch_assoc();
        $oldssn = $row['Emp_SSN'];
    }

    // Update the EMPLOYEE table with a temporary SSN
    $update_employee = "UPDATE EMPLOYEE SET Emp_SSN = '$empSSN', FName = '$fName', MInit = '$mInit', LName = '$lName', Facility_ID = '$facilityID', Salary = '$salary', Hire_Date = '$hireDate', Job_Class = '$jobClass', Street = '$street', City = '$city', Zip = '$zip' WHERE Emp_ID = '$empID'";
    $result_employee = $con->query($update_employee);

    if ($result_employee) {

        $update_other_hcp = "UPDATE OTHER_HCP SET HCP_SSN = '$empSSN' WHERE HCP_SSN = '$oldssn'";
        $result_other_hcp = $con->query($update_other_hcp);

        // Update doctor table
        $update_doctor = "UPDATE DOCTOR SET Doctor_SSN = '$empSSN' WHERE Doctor_SSN = '$oldssn'";
        $result_doctor = $con->query($update_doctor);

        // Update nurse table
        $update_nurse = "UPDATE NURSE SET Nurse_SSN = '$empSSN' WHERE Nurse_SSN = '$oldssn'";
        $result_nurse = $con->query($update_nurse);

        // Update admin table
        $update_admin = "UPDATE ADMIN SET Admin_SSN = '$empSSN' WHERE Admin_SSN = '$oldssn'";
        $result_admin = $con->query($update_admin);

        $update_patient = "UPDATE PATIENT SET Doctor_Employee_SSN = '$empSSN' WHERE Doctor_Employee_SSN = '$oldssn'";
        $result_patient = $con->query($update_patient);

        $update_treats = "UPDATE TREATS SET Doctor_SSN = '$empSSN' WHERE Doctor_SSN = '$oldssn'";
        $result_treats = $con->query($update_treats);

        $update_make_appointment = "UPDATE MAKE_APPOINTMENT SET Doctor_SSN = '$empSSN' WHERE Doctor_SSN = '$oldssn'";
        $result_make_appointment = $con->query($update_make_appointment);

        $response['status'] = 'success';
        $response['message'] = 'Updating EMPLOYEE data Successfully';

    } else {
        // Send an error response
        $response['status'] = 'error';
        $response['message'] = 'Error updating EMPLOYEE data: ' . $con->error;
    }
} else {
    // If POST data is not set, send an error response
    $response['status'] = 'error';
    $response['message'] = 'POST data not received';
}

// Send JSON response
echo json_encode($response);

?>