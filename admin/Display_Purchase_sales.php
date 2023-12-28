<?php
include('Authentication.php');
require "../connection.php";

if(isset($_POST['submit'])){
    $transaction_type=$_POST['transaction_type'];
}
$query = "SELECT purchase_sales_tbl.*, customer_supplier_tbl.Name AS customer_supplier_name, customer_supplier_tbl.Contact As Contact, ps_detail_tbl.*, product_tbl.pname FROM purchase_sales_tbl LEFT JOIN customer_supplier_tbl ON purchase_sales_tbl.csId = customer_supplier_tbl.csId LEFT JOIN ps_detail_tbl ON purchase_sales_tbl.psId = ps_detail_tbl.psId LEFT JOIN product_tbl ON ps_detail_tbl.p_id = product_tbl.pid";

if(!empty($transaction_type)){
    $query .=" WHERE purchase_sales_tbl.transaction_type='$transaction_type'";
}
$query .= " ORDER BY purchase_sales_tbl.date DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
        }

        .dataTables_length {
            margin-bottom: 15px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-11">
                    <h5 class="fw-bold">Transactions History</h5>
                    </div>
                    <div class="col-1">
                        <a href="./Display_Purchase_sales.php"><button class="btn btn"><i class="bi bi-arrow-clockwise"></i></button></a>
                    </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-8"></div>
                        <div class="col-4">
                            <form action="" method="post">
                                <div class="row">
                                    <div class="col-8">
                                        <!-- <label class="form-label fw-bold" for="transaction_type">Transaction Type</label> -->
                                        <select class="form-select" id="transaction_type" name="transaction_type">
                                            <option value="" selected disabled>Select Transaction Type</option>
                                            <option value="purchase" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type'] === 'purchase') echo 'selected'; ?>>Purchase</option>
                                            <option value="sale" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type'] === 'sale') echo 'selected'; ?>>Sales</option>
                                            <!-- <option value="purchase_sale" <?php if(isset($_POST['transaction_type']) && $_POST['transaction_type'] === 'purchase_sale') echo 'selected'; ?>>Purchase Sales</option> -->
                                        </select>
                                    </div>
                                    <div class="col-4">
                                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Customer/Supplier Name</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Transaction Type</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">Total Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;


                                while ($ps_detail_row = mysqli_fetch_assoc($result)) {

                                    $total_amount=$ps_detail_row['quantity'] * $ps_detail_row['rate'];
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo $count++; ?>
                                        </th>
                                        <td>
                                            <?php echo $ps_detail_row['date']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['customer_supplier_name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['Contact'] ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['transaction_type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['pname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['quantity']; ?>
                                        </td>
                                        <td>
                                            <?php echo $ps_detail_row['rate']; ?>
                                        </td>
                                        <td>
                                            <?php echo $total_amount ?>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jquery link -->
    <script src="../Assets/jquery.min.js"></script>
    <script src="../Assets/DataTables/datatables.min.js"></script>
    <script>
        $('#myTable').DataTable({
            "ordering": false,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            // "scrollX":true;
            language: {
                search: "_INPUT_",
                searchplaceholder: "search...."
            }
        });
    </script>
</body>

</html>