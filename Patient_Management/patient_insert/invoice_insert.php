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
                    <label for="Invoice_Date">Invoice Date:</label>
                    <input type="date" class="form-control datepicker" id="Invoice_Date" name="Invoice_Date" required>
                </div>
                <div class="form-group">
                    <label for="Insurance_ID">Insurance ID:</label>
                    <select class="form-control" id="Insurance_ID" name="Insurance_ID" required>
                        <option value="">Select Insurance ID</option>
                        <?php
                        require_once '../../db.php'; // Include your database connection file
                        // Retrieve possible Insurance ID values from the INSURANCE_COMPANY table
                        $insuranceQuery = "SELECT Insurance_ID FROM INSURANCE_COMPANY";
                        $insuranceResult = $con->query($insuranceQuery);
                        while ($row = $insuranceResult->fetch_assoc()) {
                            echo '<option value="' . $row['Insurance_ID'] . '">' . $row['Insurance_ID'] . '</option>';
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
    <!-- Bootstrap Datepicker library -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Other scripts depending on jQuery -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    <!-- PHP logic for displaying SweetAlert messages -->
    <?php
    require_once '../../db.php'; // Include your database connection file
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Invoice_Date = $_POST['Invoice_Date'];
        $Insurance_ID = $_POST['Insurance_ID'];

        // SQL query to insert data into INVOICE table
        $sql = "INSERT INTO INVOICE (Invoice_Date, Insurance_ID) 
                    VALUES ('$Invoice_Date', '$Insurance_ID')";

        if ($con->query($sql) === TRUE) {
            echo '<script>
                    Swal.fire({
                      icon: "success",
                      title: "Success!",
                      text: "New record created successfully"
                    }).then((value) => {
                      window.location.href = "invoice_insert.php";
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
    ?>
</body>

</html>