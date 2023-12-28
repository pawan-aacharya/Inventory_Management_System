<?php
require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboad</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
    <script src="../Assets/script.js"></script>
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="heading">
                        <h4>Search Products</h4>
                    </div>
                    <form action="#" method="post">
                        <div class="row">
                            <div class="col-4">
                            </div>
                            <div class="col-4">
                                <div class="input-group">
                                    <div class="form-outline">
                                        <input type="search" name="search" id="form1" class="form-control" />
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="search">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-4">
                            </div>
                        </div>
                    </form>
                    <?php
                    if (isset($_POST['search'])) {
                        $search = $_POST['search'];
                        $query = "SELECT * FROM product_tbl WHERE p_name LIKE '%$search%' OR cat_name LIKE '%$search%' OR subcat_name LIKE '%$search%' OR brand_name LIKE '%$search%'";
                        $result = mysqli_query($conn, $query);
                        $i = 0;
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table m-2" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Cat Name</th>
                                    <th scope="col">Subcat Name</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Price(per pic)</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>';

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tbody>
                                <tr>
                                    <td>"
                                    . $row['p_name'] .
                                    "</td>
                                    <td>"
                                    . $row['cat_name'] .
                                    "</td>
                                    <td>"
                                    . $row['subcat_name'] .
                                    "</td>
                                    <td>"
                                    . $row['b_name'] .
                                    "</td>
                                    <td>"
                                    . $row['price'] .
                                    "</td>
                                    <td>"
                                    . $row['quantity'] .
                                    "</td>
                                    <td>"
                                    . $row['created_date'] .
                                    "</td>
                                    <td>"
                                    . $row['status'] .
                                    "</td>
                                </tr>
                            </tbody>
                        </table>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>