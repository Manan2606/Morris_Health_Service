<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Invoice</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css"
    rel="stylesheet">
  <style>
    body {
      padding: 50px;
    }

    .form-container {
      max-width: 500px;
      margin: 0 auto;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="form-container">
      <h2>Add Invoice</h2>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <div class="form-group">
          <label for="Invoice_ID">Invoice ID:</label>
          <select class="form-control" id="Invoice_ID" name="Invoice_ID" required>
            <option value="">Select Invoice ID</option>
            <?php

            require_once '../../db.php'; // Include your database connection file
            // Retrieve possible Invoice ID values from the INVOICE table
            $invoiceQuery = "SELECT Invoice_ID FROM INVOICE";
            $invoiceResult = $con->query($invoiceQuery);
            while ($row = $invoiceResult->fetch_assoc()) {
              echo '<option value="' . $row['Invoice_ID'] . '">' . $row['Invoice_ID'] . '</option>';
            }
            ?>
          </select>
        </div>
        <div class="form-group">
          <label for="Cost">Cost:</label>
          <input type="number" step="0.01" class="form-control" id="Cost" name="Cost" required>
        </div>
        <div class="form-group">
          <label for="Make_Appointment_ID">Appointment ID:</label>
          <select class="form-control" id="Make_Appointment_ID" name="Make_Appointment_ID" required>
            <option value="">Select Appointment ID</option>
            <?php

            require_once '../../db.php'; // Include your database connection file
            // Retrieve possible Appointment ID values from the MAKE_APPOINTMENT table
            $appointmentQuery = "SELECT Make_Appointment_ID FROM MAKE_APPOINTMENT";
            $appointmentResult = $con->query($appointmentQuery);
            while ($row = $appointmentResult->fetch_assoc()) {
              echo '<option value="' . $row['Make_Appointment_ID'] . '">' . $row['Make_Appointment_ID'] . '</option>';
            }
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <!-- Back button container -->
  <div class="container-fluid text-center mt-3 back-button-container">
    <a href="../patient_management.php" class="btn btn-secondary">Back</a>
  </div>

  <!-- SweetAlert2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <!-- jQuery library -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <!-- Bootstrap Datepicker library -->
  <script
    src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

  <!-- PHP logic for displaying SweetAlert messages -->
  <?php
  require_once '../../db.php'; // Include your database connection file
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Invoice_ID = $_POST['Invoice_ID'];
    $Cost = $_POST['Cost'];
    $Make_Appointment_ID = $_POST['Make_Appointment_ID'];

    // Check if the combination of Make_Appointment_ID and Invoice_ID already exists
    $checkQuery = "SELECT * FROM INVOICE_DETAIL WHERE Make_Appointment_ID = '$Make_Appointment_ID' AND Invoice_ID = '$Invoice_ID'";
    $checkResult = $con->query($checkQuery);
    if ($checkResult->num_rows > 0) {
      echo '<script>
        Swal.fire({
          icon: "error",
          title: "Error!",
          text: "This combination of Appointment ID and Invoice ID already exists. Please select another one."
        });
      </script>';
    } else {
      // Insert data into INVOICE_DETAIL table
      $sql = "INSERT INTO INVOICE_DETAIL (Invoice_ID, Cost, Make_Appointment_ID) 
              VALUES ('$Invoice_ID', '$Cost', '$Make_Appointment_ID')";

      if ($con->query($sql) === TRUE) {
        echo '<script>
              Swal.fire({
                icon: "success",
                title: "Success!",
                text: "New record created successfully"
              }).then((value) => {
                window.location.href = "invoice_detail_insert.php";
              });
            </script>';
      } else {
        echo '<script>
              Swal.fire({
                icon: "error",
                title: "Error!",
                text: "Error: ' . $sql . '<br>' . $con->error . '"
              });
            </script>';
      }
    }
  }
  ?>

</body>

</html>