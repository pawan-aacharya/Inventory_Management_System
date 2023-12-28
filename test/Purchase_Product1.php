<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['purchase'])) {
    $customer_supplier_id = $_POST['customer_supplier_id'];
    $transaction_type = "Purchase";
    $product_ids = $_POST['product_id'];
    $quantities = $_POST['quantity'];
    $rates = $_POST['rate'];
    $total_amount = $quantities*$rates;
    date_default_timezone_set("Asia/Kathmandu");
    $psdate = date("Y-m-d h:i:sa");
    $purchase_sales_query = "INSERT INTO purchase_sales_tbl (csId, date, transaction_type, total_amount) VALUES ('$customer_supplier_id', '$psdate', 'Purchase', '$total_amount')";
    $result=mysqli_query($conn,$purchase_sales_query);
    if ($result) { 
        $sql="SELECT MAX(psId)
        FROM purchase_sales_tbl";  
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        $psId = $row['MAX(psId)'];        
            $ps_detail_query = "INSERT INTO ps_detail_tbl (psId, p_id, quantity, rate) VALUES ('$psId', '$product_ids', '$quantities', '$rates')";

            mysqli_query($conn, $ps_detail_query);

        header("Location: Display_Purchase_Sales.php");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        
    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Purchase</h5>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i class="bi bi-plus"></i>
                                Purchase</p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold" for="exampleFormControlSelect1">Supplier
                                        Name</label>
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        name="customer_supplier_id">
                                        <option selected disabled>Select Supplier Name</option>
                                        <?php
                                        $query = "SELECT * FROM customer_supplier_tbl WHERE `Type`='Supplier'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['csId']; ?>"><?php echo $row['Name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold" for="exampleFormControlSelect1">Product
                                        Name</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="product_id">
                                        <option selected disabled>Select Product</option>
                                        <?php
                                        $query = "SELECT pid, pname FROM product_tbl";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['pid']; ?>"><?php echo $row['pname']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Quantity</label>
                                        <input type="number" id="form8Example1" name="quantity" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Rate(per quantity)</label>
                                        <input type="number" id="form8Example1" name="rate" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="purchase" class="btn btn-primary">Purchase</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>






<?php
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Purchase Product</h5>

                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i class="bi bi-plus"></i>
                                Purchase</p>
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 border border-white rounded p-3" style="background-color: #B9B9B9;">
                                    <select class="form-select" id="exampleFormControlSelect1"
                                        name="customer_supplier_id">
                                        <option selected disabled>Select Supplier Name</option>
                                        <?php
                                        $query = "SELECT * FROM customer_supplier_tbl WHERE `Type`='Supplier'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['csId']; ?>"><?php echo $row['Name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="submit" name="purchase" class="btn btn-primary">Purchase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>





<?php
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['purchase'])) {
    $customer_supplier_id = $_POST['customer_supplier_id'];
    $products = $_POST['products'];

    // Insert purchase details into your database
    // ... Your database insert logic here ...
}



if (isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];

    // Insert product into the purchase_cart table
    $insert_query = "INSERT INTO purchase_cart (`product`, `quantity`, `rate`) VALUES ('$product_name', '$quantity', '$rate')";
    $insert_result = mysqli_query($conn, $insert_query);
    if ($insert_result) {
        echo "Data inserted successfully";
    } else {
        echo "insertion failed" . mysqli_error($conn);
    }
    header("location:Purchase_Product.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
     <script>
        $(document).ready(function () {
            // Fetch cart data function
            function fetchCartData() {
                $.ajax({
                    url: "Fetch_Cart_Data.php", // Path to your PHP script to fetch cart data
                    type: "POST",
                    dataType: "json",
                    success: function (data) {
                        var tableBody = $("#cartTable tbody");
                        tableBody.empty();

                        if (data.length > 0) {
                            $.each(data, function (index, item) {
                                var row = $("<tr></tr>");
                                row.append("<td>" + item.product + "</td>");
                                row.append("<td>" + item.quantity + "</td>");
                                row.append("<td>" + item.rate + "</td>");
                                tableBody.append(row);
                            });
                        } else {
                            var row = $("<tr></tr>").append("<td colspan='3'>No items in cart</td>");
                            tableBody.append(row);
                        }
                    }
                });
            }

            // Initial cart data fetch
            fetchCartData();
        })
    </script>
</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-10 mb-2">
                            <h5 class="fw-bold">Purchase Product</h5>
                        </div>
                        <div class="col-2 mb-2"><button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#addProductModal">Add Product</button></div>
                    </div>

                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <div class="row">
                                <div class="col-4"></div>
                                <div class="col-4 border border-white rounded p-3" style="background-color: #B9B9B9;">
                                    <select class="form-select" id="customer_supplier_id" name="customer_supplier_id">
                                        <option selected disabled>Select Supplier Name</option>
                                        <?php
                                        $query = "SELECT * FROM customer_supplier_tbl WHERE `Type`='Supplier'";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                            <option value="<?php echo $row['csId']; ?>"><?php echo $row['Name']; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col-4"></div>
                            </div>
                            <?php
                            $cart_query = "SELECT * FROM purchase_cart ";
                            $cart_result = mysqli_query($conn, $cart_query);
                            ?>
                            <table class="table table-bordered">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Rate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                     while ($row = mysqli_fetch_assoc($cart_result)) {
                                        $product = $row['product'];
                                        $quantity = $row['quantity'];
                                        $rate = $row['rate']; 
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $product ?>
                                            </td>
                                            <td>
                                                <?php echo $quantity ?>
                                            </td>
                                            <td>
                                                <?php echo $rate ?>
                                            </td>
                                        </tr>
                                    <?php 
                                }
                                 ?>
                                </tbody>
                            </table>
                            <div class="row mt-3">
                                <div class="col-12 text-end">
                                    <button type="submit" name="purchase" class="btn btn-primary">Purchase</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php

    ?>

    <!-- Add Product Modal -->
   
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Product form fields (Name, Quantity, Rate) -->
                    <form id="productForm" action="Purchase_Product.php" method="post">
                        <div class="mb-3">
                            <label class="fw-bold" for="product_name" class="form-label">Product Name</label>
                            <select class="form-select" id="product_id" name="product_name">
                                <option selected disabled>Select Product Name</option>
                                <?php
                                $query = "SELECT * FROM product_tbl";
                                $result = mysqli_query($conn, $query);
                                while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                    <option value="<?php echo $row['pname']; ?>"><?php echo $row['pname']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold" for="quantity" class="form-label">Quantity</label>
                            <input type="number" class="form-control" id="quantity" name="quantity" required>
                        </div>
                        <div class="mb-3">
                            <label class="fw-bold" for="rate" class="form-label">Rate</label>
                            <input type="number" class="form-control" id="rate" name="rate" required>
                        </div>
                        <button type="submit" name="add"  class="btn btn-primary" id="addProductBtn">Add</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>