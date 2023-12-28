<?php
include "Authentication.php";
require "../connection.php";

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
                    <h5 class="fw-bold">Manage Inventory</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Total Purchase</th>
                                    <th scope="col">Remaining Stock</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                $product_query = "SELECT pid, pname, unit, cat_name, b_name FROM categories_tbl INNER JOIN brand_tbl ON categories_tbl.cat_id=brand_tbl.cat_id INNER JOIN product_tbl ON brand_tbl.b_id=product_tbl.brand_id; ";
                                $product_result = mysqli_query($conn, $product_query);

                                while ($product_row = mysqli_fetch_assoc($product_result)) {
                                    $product_id = $product_row['pid'];
                                    $category_name=$product_row['cat_name'];
                                    $unit=$product_row['unit'];
                                    $brand_name=$product_row['b_name'];
                                    $inventory_query = "SELECT *, SUM(CASE WHEN ps.`transaction_type` = 'Sale' THEN psd.`quantity` ELSE 0 END) AS total_sold_quantity,SUM(CASE WHEN ps.`transaction_type` = 'Purchase' THEN psd.`quantity` ELSE 0 END) AS total_purchase_quantity FROM ps_detail_tbl psd INNER JOIN purchase_sales_tbl ps on psd.psId=ps.psId WHERE psd.p_id='$product_id'";
                                    $inventory_result = mysqli_query($conn, $inventory_query);

                                    while ($inventory_row = mysqli_fetch_assoc($inventory_result)) {
                                        $p_id = $inventory_row['p_id'];
                                        $sold_quantity = $inventory_row['total_sold_quantity'];
                                        $purchase_quantity = $inventory_row['total_purchase_quantity'];
                                        $remaining_stock = $purchase_quantity - $sold_quantity;
                                ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo $count++; ?>
                                            </th>
                                            <td>
                                                <?php echo $product_row['pname']; ?>
                                            </td>
                                            <td>
                                                <?php echo $category_name; ?>
                                            </td>
                                            <td>
                                                <?php echo $brand_name; ?>
                                            </td>
                                            <?php
                                            if ($purchase_quantity == null) {
                                                $purchase_quantity = 0;
                                            }
                                            ?>
                                            <td>
                                                <?php echo $purchase_quantity ."<span style='margin-left:7px;'>". $unit."</span>"; ?>
                                            </td>
                                            <td>
                                                <?php echo $remaining_stock;  ?>
                                            </td>
                                            <td>
                                                <!-- <button type="button" id="<?php echo $product_id; ?>" class="btn btn-primary">View</button> -->
                                                <a href="./Ledger.php?pid=<?php echo $p_id; ?>"><button class="btn btn-primary">view</button></a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal" id="myModal">
                        <div class="modal-dialog">
                            <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Modal Heading</h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">


                                </div>

                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                </div>

                            </div>
                        </div>
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
                [15, 25, 50, 100, -1],
                [15, 25, 50, 100, "All"]
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