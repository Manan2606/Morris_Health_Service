<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Get revenue report</title>
</head>

<body>

    <div class="container" style="margin: 50px;">
        <div class="row">
            <div class="col">
                <form method="post">
                    <label for="startDate">Please select start date:</label>
                    <input type="date" id="startDate" name="startDate" required>

                    <label for="endDate" style="margin-left: 100px;">Please select end date:</label>
                    <input type="date" id="endDate" name="endDate" required>
            </div>
        </div>

        <?php
        require_once '../db.php';
        $sql1 = "SELECT Name FROM insurance_company";
        $result1 = mysqli_query($con, $sql1);
        ?>

        <select class="form-select" name="companyName" aria-label="Default select example" style="margin-top: 50px; margin-bottom:50px;" required>
            <option selected>Select insurance company</option>
            <?php
            while ($row = mysqli_fetch_assoc($result1)) {
                $Name = $row['Name'];
                echo "<option value='$Name'>$Name</option>";
            }
            ?>
        </select>


        <div class="row mt-2">
            <div class="col">
                <button type="submit" class="btn btn-primary">Get Summary</button>
                </form>
            </div>
        </div>
    </div>


    <?php
    require_once '../db.php';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $companyName = $_POST['companyName'];
        $numberOfRecords=0;
        $totalCost=0;

        $sql2 = "SELECT  AVG(invd.Cost)as avg_cost, inv.Invoice_ID, inv.Invoice_Date, invd.Invoice_Detail_ID, invd.Cost, isc.Insurance_ID from insurance_company as isc
        JOIN invoice as inv ON inv.Insurance_ID = isc.Insurance_ID
        JOIN invoice_detail as invd ON inv.Invoice_ID = invd.Invoice_ID
        WHERE inv.Invoice_Date>='$startDate' AND inv.Invoice_Date<='$endDate' AND isc.Name='$companyName'
        GROUP BY(inv.Invoice_Date);";
        $result2 = mysqli_query($con, $sql2);

        echo '<div style="margin-left: 300px; margin-right:250px;">';
            echo "<h1 class='text-center mb-4'>Your individual record</h1>";
            echo "<div class='table-responsive'>";
            echo "<table class='table table-striped table-bordered'>";
            echo "<thead class='thead-dark'>
            <tr>
                <th>Invoice Detail ID</th>
                <th>Invoice Date</th>
                <th>Average Cost</th>
            </tr>
        </thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_assoc($result2)) {
            echo "<tr>
                <td>" . $row["Invoice_Detail_ID"] . "</td>
                <td>" . $row["Invoice_Date"] . "</td>
                <td>" . $row["avg_cost"] . "</td>
            </tr>";
        }
        echo "</tbody>";
        echo "</table>";
        echo '</div>';
    }
    ?>

<div class="container mt-3">
        <a href="management_reports.php" class="btn btn-secondary">Back</a>
    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>