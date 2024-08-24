<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Get best 5 days</title>
</head>

<body>
    <form method="post">
        <div class="container" style="flex-direction: column; display: flex; justify-content:center;">
            <div class="dropdown">
                <select class="form-select" name="selectedMonth" aria-label="Default select example" style="margin-top: 50px; margin-bottom:50px; align-items:center;" required>
                    <option selected>Select your month</option>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
                <button style="width: 200px;" type="submit" class="btn btn-success">Get your best five days.</button>
            </div>
        </div>
    </form>

    <div class="container mt-3">
        <a href="management_reports.php" class="btn btn-secondary">Back</a>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

<?php
require_once '../db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $selectedMonth = $_POST['selectedMonth'];
    $sql = "SELECT inv.Invoice_Date, inv.invoice_ID, SUM(invd.Cost) as TotalCost FROM invoice as inv 
            JOIN
            invoice_detail as invd ON inv.Invoice_ID = invd.Invoice_ID
            WHERE (MONTH(inv.Invoice_Date) = '$selectedMonth')
            GROUP BY (invd.Cost) DESC
            LIMIT 5;";
    $result = mysqli_query($con, $sql);
    echo '<div style="margin-left: 300px; margin-right:250px; margin-top:100px;">';
    echo "<h1 class='text-center mb-4'>Your individual record</h1>";
    echo "<div class='table-responsive'>";
    echo "<table class='table table-striped table-bordered'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th>Invoice Date</th>
                <th>Total Cost</th>
            </tr>
        </thead>";
    echo "<tbody>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row["Invoice_Date"] . "</td>
                <td>" . $row["TotalCost"] . "</td>
            </tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo '</div>';
}
?>


</html>