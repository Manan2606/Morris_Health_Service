<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Patient</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
            <h2>Add Insurance Company</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="form-group">
                    <label for="Name">Name:</label>
                    <input type="text" class="form-control" id="Name" name="Name" required>
                </div>
                <div class="form-group">
                    <label for="Street">Street:</label>
                    <input type="text" class="form-control" id="Street" name="Street">
                </div>
                <div class="form-group">
                    <label for="City">City:</label>
                    <input type="text" class="form-control" id="City" name="City">
                </div>
                <div class="form-group">
                    <label for="State">State:</label>
                    <input type="text" class="form-control" id="State" name="State">
                </div>
                <div class="form-group">
                    <label for="Zip">Zip:</label>
                    <input type="text" class="form-control" id="Zip" name="Zip">
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
    <!-- PHP logic for displaying SweetAlert messages -->
    <?php
    require_once '../../db.php'; // Include your database connection file
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['Name'];
        $street = $_POST['Street'];
        $city = $_POST['City'];
        $state = $_POST['State'];
        $zip = $_POST['Zip'];

        // SQL query to insert data into PATIENT table
        $sql = "INSERT INTO INSURANCE_COMPANY (Name, Street, City, State, Zip) 
                    VALUES ('$name', '$street', '$city', '$state', '$zip')";

        if ($con->query($sql) === TRUE) {
            echo '<script>
                        Swal.fire({
                          icon: "success",
                          title: "Success!",
                          text: "New record created successfully"
                        }).then((value) => {
                          window.location.href = "insurance_company_insert.php";
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