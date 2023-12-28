<?php
include('Authentication.php');
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {

    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $query = "SELECT
    p.pname AS Product_Name,
    ps.date AS Transaction_Date,
    cs.Name AS Customer_Supplier_Name,
    psd.quantity AS Quantity,
    psd.rate AS rate,
    ps.transaction_type AS Transaction_Type,
    ps.total_amount AS Total_Amount
FROM
    ps_detail_tbl AS psd
INNER JOIN
    product_tbl AS p ON psd.p_id = p.pid
INNER JOIN
    purchase_sales_tbl AS ps ON psd.psId = ps.psId
INNER JOIN
    customer_supplier_tbl AS cs ON ps.csId = cs.csId WHERE ps.transaction_type='sale' AND DATE(ps.date) BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
</head>

<body id="body">
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="heading">
                        <h4 class="mb-4 fw-bold">Sales Report</h4>
                    </div>
                    <hr>
                    <form action="" method="post" class="border border-white rounded p-3" style="background-color: #B9B9B9;">
                        <div class="row mx-5">
                            <div class="col-5 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">Start Date</label>
                                    <input type="date" id="form8Example1" name="start_date" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-5 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">End Date</label>
                                    <input type="date" id="form8Example1" name="end_date" class="form-control" required>
                                </div>
                            </div>
                        
                        <div class="col-2 text-center" style="margin-top: 30px;">
                            <button type="submit" class="btn btn-primary" name="search">Search
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                        </div>
                    </form>
                    <hr>
                    
                        <?php
                        if (isset($result)) {
                            if (mysqli_num_rows($result) > 0) {
                                $grand_total=0;
                                echo "<h3>Search Results:</h3>";
                                echo "<div class='print mt-2 mb-2'>";
                                echo "<button class='btn' onclick='printPage();' id='print' ><i class='bi bi-printer-fill'></i>Print</button>";
                                echo "</div>";
                                echo "<div id='data'>";
                                echo "<table class='table table-bordered'>";
                                echo "<thead class='bg-dark text-white'>";
                                echo "<tr>";
                                echo "<th>S.N.</th>";
                                echo "<th>Date</th>";
                                echo "<th>Customer supplier Name</th>";
                                echo "<th>Product Name</th>";
                                echo "<th>Quantity</th>";
                                echo "<th>rate</th>";
                                echo "<th>Transaction Type</th>";
                                echo "<th>Total Amount(Rs)</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                
                                $i = 0;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $date = $row['Transaction_Date'];
                                    $customer_supplier_name = $row['Customer_Supplier_Name'];
                                    $Product_name = $row['Product_Name'];
                                    $quantity = $row['Quantity'];
                                    $rate=$row['rate'];
                                    $transaction_type = $row['Transaction_Type'];
                                    $total_amount = $row['Total_Amount'];
                                    echo "<tr>";
                                    echo "<td>" . ++$i . "</td>";
                                    echo "<td>" . $date . "</td>";
                                    echo "<td>" . $customer_supplier_name . "</td>";
                                    echo "<td>" . $Product_name . "</td>";
                                    echo "<td>" . $quantity . "</td>";
                                    echo "<td>" . $rate . "</td>";
                                    echo "<td>" . $transaction_type . "</td>";
                                    echo "<td>" . $total_amount . "</td>";
                                }

                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<h4>No any transaction found between the given dates.</h4>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script type="text/JavaScript">
        function printPage() {
            body=document.getElementById('body').innerHTML;
            data=document.getElementById('data').innerHTML;
            document.getElementById('body').innerHTML=data;
            window.print();
            document.getElementById('body').innerHTML=body;
        }
    </script>
</body>

</html>