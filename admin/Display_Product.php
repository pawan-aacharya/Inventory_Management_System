<?php
include('Authentication.php');
require "../connection.php";

?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboad</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus {
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
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row ">
                        <div class="col-10">
                            <h5 class="fw-bold">Manage Products</h5>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-primary mb-2" href="Add_Product.php" role="button"><i class="bi bi-plus"></i>Add Product</a>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT p.pname, p.sales_rate, p.created_date, c.cat_name, b.b_name
                   FROM product_tbl AS p
                   INNER JOIN brand_tbl AS b ON p.brand_id = b.b_id
                   INNER JOIN categories_tbl AS c ON b.cat_id = c.cat_id";

                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    ?>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped m-2 " id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Sales Rate</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT p.pid, p.pname, p.sales_rate, p.created_date,p.status, c.cat_name, b.b_name
                                      FROM product_tbl AS p
                                      INNER JOIN brand_tbl AS b ON p.brand_id = b.b_id
                                      INNER JOIN categories_tbl AS c ON b.cat_id = c.cat_id";

                                $result = mysqli_query($conn, $query);
                                $i = 0;

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $Product_id = $row['pid'];
                                    $pname = $row['pname'];
                                    $category_name = $row['cat_name'];
                                    $brand_name = $row['b_name'];
                                    $sales_rate = $row['sales_rate'];
                                    $created_date = $row['created_date'];
                                    $product_status=$row['status'];
                                    if($product_status==1){
                                        $product_status="active";
                                    }else{
                                        $product_status="inactive";
                                    }
                                ?>
                                    <tr>
                                        <td scope="row">
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $pname ?>
                                        </td>
                                        <td>
                                            <?php echo $category_name ?>
                                        </td>
                                        <td>
                                            <?php echo $brand_name ?>
                                        </td>
                                        <td>
                                            <?php echo $sales_rate ?>
                                        </td>
                                        <td>
                                            <?php echo $created_date ?>
                                        </td>
                                        <td>
                                            <?php echo $product_status ?>
                                        </td>
                                        <td>
                                            <a href="Edit_Product.php?pid=<?php echo $Product_id; ?>"><button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                            <a href="Delete_Product.php?pid=<?php echo $Product_id; ?>"><button class="btn btn-danger" onclick="return confirm('are you sure want to delete?');"><i class="bi bi-trash-fill"></i></button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
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