<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Insert Facility</title>
</head>

<body>

    <form method="post" style="margin: 40px;">
        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="1234 Main St" required>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity" name="inputCity" required>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <input type="text" class="form-control" id="inputState" name="inputState" required>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="number" class="form-control" id="inputZip" name="inputZip" required maxlength="6">
            </div>
            <div class="row d-flex justify-content-center">
                <div class="col">
                    <label for="facility_size">Enter your Facility Size</label>
                    <input type="number" class="form-control" id="facility_size" name="facility_size" required>
                </div>
                <div class="col">
                    <label for="facility_type">Enter your Facility Type</label>
                    <input type="text" class="form-control" id="facility_type" name="facility_type" required>
                </div>
                <div class="col" style="margin-top: 30px;">
                    <button type="submit" class="btn btn-success">Insert Facility</button>
                </div>
            </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

<?php
require_once 'C:\xampp\htdocs\mhs\db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputAddress = isset($_POST['inputAddress']) ? $_POST['inputAddress'] : '';
    $inputCity = isset($_POST['inputCity']) ? $_POST['inputCity'] : '';
    $inputState = isset($_POST['inputState']) ? $_POST['inputState'] : '';
    $inputZip = isset($_POST['inputZip']) ? $_POST['inputZip'] : '';
    $facility_size = isset($_POST['facility_size']) ? $_POST['facility_size'] : '';
    $facility_type = isset($_POST['facility_type']) ? $_POST['facility_type'] : '';

    $sql = "INSERT INTO `facility`(`Street`, `City`, `State`, `Zip`, `Facility_Size`, `Facility_Type`) 
    VALUES ('$inputAddress','$inputCity','$inputState','$inputZip','$facility_size','$facility_type');";
    $result = $con->prepare($sql);

    if ($result->execute()) {
        echo '<script>alert("Facility data inserted successfully!")</script>';
    } else {
        echo '<script>alert("Error inserting data: ' . $con->error . '")</script>';
    }
}
?>

</html>