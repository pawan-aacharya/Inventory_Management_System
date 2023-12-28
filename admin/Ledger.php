<?php
include('Authentication.php');
require "../connection.php";

// Get the product ID from the query parameter
$product_id = isset($_GET['pid']) ? $_GET['pid'] : null;
// Fetch the product name based on the product ID
$product_name = "";
if ($product_id) {
    $product_query = "SELECT pname FROM product_tbl WHERE pid = '$product_id'";
    $product_result = mysqli_query($conn, $product_query);
    $product_row = mysqli_fetch_assoc($product_result);
    $product_name = $product_row['pname'];
}

if (isset($_POST['submit'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $selectQuery = "SELECT
        ps.date,
        CASE
            WHEN ps.transaction_type = 'purchase' THEN 'Purchase'
            WHEN ps.transaction_type = 'sale' THEN 'Sale'
            ELSE ''
        END AS particular,
        CASE
            WHEN ps.transaction_type = 'purchase' THEN psd.quantity
            ELSE 0
        END AS stock_in,
        CASE
            WHEN ps.transaction_type = 'sale' THEN psd.quantity
            ELSE 0
        END AS stock_out,
        (
            SELECT SUM(
                CASE
                    WHEN ps1.transaction_type = 'purchase' THEN psd1.quantity
                    ELSE -psd1.quantity
                END
            )
            FROM ps_detail_tbl psd1
            JOIN purchase_sales_tbl ps1 ON psd1.psId = ps1.psId
            WHERE ps1.date <= ps.date AND psd1.p_id = '$product_id'
        ) AS balance,
        CASE
            WHEN ps.transaction_type = 'purchase' THEN psd.rate
            WHEN ps.transaction_type = 'sale' THEN psd.rate
            ELSE 0
        END AS rate
    FROM ps_detail_tbl psd
    JOIN purchase_sales_tbl ps ON psd.psId = ps.psId
    WHERE psd.p_id = '$product_id' AND Date(ps.date) BETWEEN '$start_date' AND '$end_date'
    ORDER BY ps.date ASC;";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">
</head>

<body id="body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- navbar toggler -->
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
            </button>

            <!-- end navbar toggler -->
            <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">Inventory Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Navigation menu here -->
            </div>
        </div>
    </nav>
    <!-- end nav -->

    <div class="container-fluid mt-5 pt-4 w-75">
        <form action="" method="post">
            <div class="row">
                <div class="col-2 print mt-2 mb-2">
                    <button class="btn" onclick="printPage();" id="print" name="print"><i class="bi bi-printer-fill"></i>Print</button>
                </div>
                <div class="col-8 mt-2 border rounded-5 p-2">
                    <div class="row g-3 align-items-center">
                        <div class="col-auto">
                            <label for="startDate" class="col-form-label fw-bold">Start Date</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="startDate" name="start_date" class="form-control" value="<?=$start_date ?>">
                        </div>
                        <div class="col-auto">
                            <label for="endDate" class="col-form-label fw-bold">End Date:</label>
                        </div>
                        <div class="col-auto">
                            <input type="date" id="endDate" name="end_date" class="form-control" value="<?=$end_date ?>">
                        </div>
                        <div class="col-auto">
                            <input type="submit" name="submit" value="Search" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col bg-white border rounded-5 p-2 m-3">
                <div id="data">
                    <?php
                    // Check if the $selectQuery variable is set, indicating that the form was submitted
                    if (isset($selectQuery)) {
                    ?>
                        <h5 class="fw-bold text-center">Stock ledger of <strong><u><?php echo $product_name; ?></u></strong>&nbsp;From <strong><u> <?=$start_date ?></u></strong> to<strong><u> <?=$end_date ?></u></strong></h5>
                    <?php
                    } else {
                    ?>
                        <h5 class="fw-bold text-center">Stock Ledger of <strong><u><?php echo $product_name; ?></u></strong></h5>
                    <?php
                    }
                    ?>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>S.N.</th>
                                    <th>Date</th>
                                    <th>Particular</th>
                                    <th>Stock In</th>
                                    <th>Stock Out</th>
                                    <th>Rate <span>(Per Unit)</span></th>
                                    <th>Balance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;

                                if (isset($selectQuery)) {
                                    // Display ledger entries based on the date filter
                                    $result = mysqli_query($conn, $selectQuery);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$i ?></th>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['particular']; ?></td>
                                            <td><?php echo $row['stock_in']; ?></td>
                                            <td><?php echo $row['stock_out']; ?></td>
                                            <td><?php echo $row['rate']; ?></td>
                                            <td><?php echo $row['balance']; ?></td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    // Display the complete ledger entries
                                    $completeLedgerQuery = "SELECT
                                        ps.date,
                                        CASE
                                            WHEN ps.transaction_type = 'purchase' THEN 'Purchase'
                                            WHEN ps.transaction_type = 'sale' THEN 'Sale'
                                            ELSE ''
                                        END AS particular,
                                        CASE
                                            WHEN ps.transaction_type = 'purchase' THEN psd.quantity
                                            ELSE 0
                                        END AS stock_in,
                                        CASE
                                            WHEN ps.transaction_type = 'sale' THEN psd.quantity
                                            ELSE 0
                                        END AS stock_out,
                                        (
                                            SELECT SUM(
                                                CASE
                                                    WHEN ps1.transaction_type = 'purchase' THEN psd1.quantity
                                                    ELSE -psd1.quantity
                                                END
                                            )
                                            FROM ps_detail_tbl psd1
                                            JOIN purchase_sales_tbl ps1 ON psd1.psId = ps1.psId
                                            WHERE ps1.date <= ps.date AND psd1.p_id = '$product_id'
                                        ) AS balance,
                                        CASE
                                            WHEN ps.transaction_type = 'purchase' THEN psd.rate
                                            WHEN ps.transaction_type = 'sale' THEN psd.rate
                                            ELSE 0
                                        END AS rate
                                    FROM ps_detail_tbl psd
                                    JOIN purchase_sales_tbl ps ON psd.psId = ps.psId
                                    WHERE psd.p_id = '$product_id'
                                    ORDER BY ps.date ASC;";

                                    $completeResult = mysqli_query($conn, $completeLedgerQuery);

                                    while ($row = mysqli_fetch_assoc($completeResult)) {
                                ?>
                                        <tr>
                                            <th scope="row"><?php echo ++$i ?></th>
                                            <td><?php echo $row['date']; ?></td>
                                            <td><?php echo $row['particular']; ?></td>
                                            <td><?php echo $row['stock_in']; ?></td>
                                            <td><?php echo $row['stock_out']; ?></td>
                                            <td><?php echo $row['rate']; ?></td>
                                            <td><?php echo $row['balance']; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="text-end">
                    <a href="./Manage_Inventory.php"><button class="btn btn-primary"><i class="bi bi-arrow-left"></i> Back to inventory</button></a>
                </div>
            </div>
        </div>
    </div>
    <script>
         function printPage(){
            var body=document.getElementById('body').innerHTML;
            var data=document.getElementById('data').innerHTML;
            document.getElementById('body').innerHTML=data;
            window.print();
            document.getElementById('body').innerHTML=body;
        }
        </script>
</body>

</html>
