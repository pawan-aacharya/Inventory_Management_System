<?php
include('Authentication.php');
require('../connection.php');
require('./Counter.php');
?>
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

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        .card {
            background-color: lightgray;
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
                    <div class="row">
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-bookmarks-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $total_categories ?></h3>
                                                        <span class="">Categories</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-tags-fill font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $total_brands ?></h3>
                                                        <span class="">Brands</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-people-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $total_customers ?></h3>
                                                        <span class="">Customers</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-people-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $total_suppliers ?></h3>
                                                        <span class="">Suppliers</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-building-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $total_products ?></h3>
                                                        <span class="">Products</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-2">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-bag-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="media-body">
                                                        <h3><?php echo "Rs.$total_purchase"; ?></h3>
                                                        <span class="">Total Purchase</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-2">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-receipt-cutoff primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="media-body">
                                                        <h3><?php echo "Rs.$total_sales"; ?></h3>
                                                        <span class="">Total Sales</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-2">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-receipt-cutoff primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="media-body">
                                                        <h3><?php echo "Rs.$total_revenue"; ?></h3>
                                                        <span class="">Total Revenue</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-bookmarks-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $low_stock_count ?></h3>
                                                        <span class="">Low of stock</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6 col-12 mt-2">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="media text-center">
                                            <div class="row">
                                                <div class="col-1"></div>
                                                <div class="col-5">
                                                    <div class="align-self-center">
                                                        <i class="bi bi-bookmarks-fill primary font-2x float-left fw-bold" style="font-size: 50px;"></i>
                                                    </div>
                                                </div>
                                                <div class="col-5">
                                                    <div class="media-body">
                                                        <h3><?php echo $out_of_stock ?></h3>
                                                        <span class="">Out of Stock</span>
                                                    </div>
                                                </div>
                                                <div class="col-1"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>