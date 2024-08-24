<?php
require_once '../../db.php';

// Fetch Facility_IDs that are in FACILITY table but not in OFFICE table
$sql = "SELECT f.Facility_ID FROM facility f LEFT JOIN office o ON f.Facility_ID = o.Facility_ID WHERE o.Facility_ID IS NULL";
$result = $con->query($sql);

// Check if query executed successfully
if ($result) {
    // Create an array to store available Facility_IDs
    $facilityIDs = array();
    
    // Fetch each row and store the Facility_ID in the array
    while ($row = $result->fetch_assoc()) {
        $facilityIDs[] = $row['Facility_ID'];
    }
    
    // Check if there are available Facility_IDs
    if (empty($facilityIDs)) {
        // Display alert if no Facility_IDs are available
        echo '<script>alert("No available Facility IDs.")window.history.back()</script>';
    }
} else {
    // Handle error if query fails
    echo '<script>alert("Error fetching facility IDs: ' . $con->error . '")</script>';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Registration</title>
</head>

<body>
    <h1 style="text-align: center;">Enter your details to get registered as Office Facility</h1>
    <form style="margin: 40px;" method="post">
        <?php if (!empty($facilityIDs)): ?>
        <div>
            <label for="facilityID">Select Facility ID</label>
            <select class="form-control" id="facilityID" name="facilityID">
                <?php
                // Loop through available Facility_IDs and create dropdown options
                foreach ($facilityIDs as $id) {
                    echo "<option value='$id'>$id</option>";
                }
                ?>
            </select>
        </div>
        <?php endif; ?>
        <div>
            <label for="room_count">Enter room count</label>
            <input type="number" style="width: 200px;" class="form-control form-icon-trailing" id="room_count"
                name="room_count" />
        </div>
        <div>
        </div>
        <button style="margin-top: 30px;" type="submit" class="btn btn-primary">Submit</button>
    </form>

    <!-- Back button container -->
    <div class="container-fluid fixed-bottom text-center mb-3">
        <a href="../facility_operations.php" class="btn btn-secondary">Back</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $facilityID = isset($_POST['facilityID']) ? $_POST['facilityID'] : '';
    $room_count = isset($_POST['room_count']) ? $_POST['room_count'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $p_code = isset($_POST['p_code']) ? $_POST['p_code'] : '';

    // Check if Facility_ID is empty
    if (empty($facilityID)) {
        echo '<script>alert("Please select a Facility ID")</script>';
    } else {
        // Proceed with insertion
        $sql2 = "INSERT INTO out_patient_surgery (Facility_ID, Room_Count, Description, P_Code)
    VALUES ('$facilityID', '$room_count', '$description', '$p_code');";
        $result2 = $con->prepare($sql2);
        if ($result2->execute()) {
            echo '<script>alert("Employee data inserted successfully!")</script>';
        } else {
            echo '<script>alert("Error inserting data: ' . $con->error . '")</script>';
        }
    }
}
?>

</html>
