<?php
include('Authentication.php');
require "../connection.php";

if (isset($_POST['search']) && isset($_POST['transaction_type'], $_POST['start_date'], $_POST['end_date'])) {
    $transaction_type = $_POST['transaction_type'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    if ($transaction_type == 'purchase') {
        $query = "SELECT
    p.pname AS Product_Name,
    ps.date AS Transaction_Date,
    cs.Name AS Customer_Supplier_Name,
    cs.Contact AS Contact,
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
    customer_supplier_tbl AS cs ON ps.csId = cs.csId WHERE ps.transaction_type = 'purchase' AND DATE(ps.date) BETWEEN '$start_date' AND '$end_date'";
    } elseif ($transaction_type == 'sale') {
        $query = "SELECT
    p.pname AS Product_Name,
    ps.date AS Transaction_Date,
    cs.Name AS Customer_Supplier_Name,
    cs.Contact AS Contact,
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
    customer_supplier_tbl AS cs ON ps.csId = cs.csId WHERE ps.transaction_type = 'sale' AND DATE(ps.date) BETWEEN '$start_date' AND '$end_date'";
    }
    elseif($transaction_type='purchase_sales'){
        $query = "SELECT
        p.pname AS Product_Name,
        ps.date AS Transaction_Date,
        cs.Name AS Customer_Supplier_Name,
        cs.Contact AS Contact,
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
        customer_supplier_tbl AS cs ON ps.csId = cs.csId WHERE DATE(ps.date) BETWEEN '$start_date' AND '$end_date'";
    }
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
    <style>
        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        </style>
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
                        <h4 class="mb-4 fw-bold">Purchase & Sales Report</h4>
                    </div>
                    <hr>
                    <form action="" method="post" class="border border-white rounded p-3" style="background-color: #B9B9B9;">
                        <div class="row mx-5">
                            <div class="col-4 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">Start Date</label>
                                    <input type="date" id="form8Example1" name="start_date" class="form-control" value="<?php echo $start_date; ?>" required>
                                </div>
                            </div>
                            <div class="col-4 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">End Date</label>
                                    <input type="date" id="form8Example1" name="end_date" class="form-control" value="<?php echo $end_date ?>" required>
                                </div>
                            </div>
                            <div class="col-2 mb-3">
                                <label class="form-label fw-bold" for="transaction_type">Transaction Type</label>
                                <select class="form-select" id="transaction_type" name="transaction_type">
                                    <option value="" selected disabled>Select</option>
                                    <option value="purchase" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type']==='purchase') echo 'selected'; ?>>Purchase</option>
                                    <option value="sale" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type']==='sale') echo 'selected'; ?>>Sales</option>
                                    <option value="purchase_sales" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type']==='purchase_sales') echo 'selected'; ?>>Purchase-Sales</option>
                                </select>
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
                            $grand_total = 0;
                            if($transaction_type=='purchase'){
                                $transaction_type="Purchase";
                            }elseif($transaction_type=='sale'){
                                $transaction_type="Sales";
                            }
                            echo "<div class='print mt-2 mb-2'>";
                            echo "<button class='btn' onclick='printPage();' id='print' ><i class='bi bi-printer-fill'></i>Print</button>";
                            echo "</div>";
                            echo "<div id='data'>";
                            echo "<h5 class='mb-2'><strong>".$transaction_type."</strong> Report From: <strong>".$start_date."</strong>  to  <strong>".$end_date."</strong></h5>";
                            echo "<table class='table table-striped mt-3'>";
                            echo "<thead class='bg-dark text-white'>";
                            echo "<tr>";
                            echo "<th>S.N.</th>";
                            echo "<th>Date</th>";
                            echo "<th>Customer supplier Name</th>";
                            echo "<th>Contact</th>";
                            echo "<th>Product Name</th>";
                            echo "<th>Quantity</th>";
                            echo "<th>Rate</th>";
                            echo "<th>Transaction Type</th>";
                            echo "<th>Total Amount(Rs)</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";

                            $i = 0;
                            $subtotal=0;
                            while ($row = mysqli_fetch_assoc($result)) {
                                $date = $row['Transaction_Date'];
                                $customer_supplier_name = $row['Customer_Supplier_Name'];
                                $contact=$row['Contact'];
                                $Product_name = $row['Product_Name'];
                                $quantity = $row['Quantity'];
                                $rate = $row['rate'];
                                $transaction_type = $row['Transaction_Type'];
                                $total_amount = $rate * $quantity;
                                $subtotal+=$total_amount;
                                echo "<tr>";
                                echo "<td>" . ++$i . "</td>";
                                echo "<td>" . $date . "</td>";
                                echo "<td>" . $customer_supplier_name . "</td>";
                                echo "<td>" . $contact . "</td>";
                                echo "<td>" . $Product_name . "</td>";
                                echo "<td>" . $quantity . "</td>";
                                echo "<td>" . $rate . "</td>";
                                echo "<td>" . $transaction_type . "</td>";
                                echo "<td>" . $total_amount . "</td>";
                                echo "</tr>";
                            }
                            echo "<tr>";
                                echo "<th colspan='7' class=''></th>";
                                echo "<th class=''>Total Amount</th>";
                                echo "<th>".$subtotal."</th>";
                                echo "</tr>";
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