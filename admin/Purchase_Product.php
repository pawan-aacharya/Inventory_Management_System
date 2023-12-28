<?php
include('Authentication.php');
require "../connection.php";

if (isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];
    if (empty($product_name)) {
        echo "<script>alert('Please Select Product Name');</script>";
    } 
    elseif($quantity==0){
        echo "<script>alert('Quantity is less than 1');</script>";
    }
    else {
        $insert_query = "INSERT INTO `cart`(`p_id`, `quantity`, `rate`, `type`) VALUES ('$product_name','$quantity','$rate','purchase')";
        $insert_result = mysqli_query($conn, $insert_query);
        if ($insert_result) {
            echo "Data inserted successfully";
        } else {
            echo "insertion failed" . mysqli_error($conn);
        }
        header("location:Purchase_Product.php");
        die;
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
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
                        <div class="col-10 mb-2">
                            <h3 class="fw-bold">Purchase Product</h3>
                        </div>
                        <div class="col-2 mb-2">
                            <a href="Add_Product.php"><button type="button" class="btn btn-primary">Add Product</button></a>
                        </div>
                        <hr>
                    </div>
                    <form id="productForm" action="Purchase_Product.php" method="post">

                        <div class="row">
                            <div class="col-4">
                                <div class="bg-white border rounded-5 m-1 p-1">
                                    <div class="mb-3">
                                        <label class="fw-bold" for="product_name" class="form-label">Product Name</label>
                                        <select class="form-select" id="product_id" name="product_name">
                                            <option selected disabled>Select Product</option>
                                            <?php
                                            $query = "SELECT * FROM product_tbl";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                            ?>
                                                <option value="<?php echo $row['pid']; ?>"><?php echo $row['pname']; ?>
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

                                    <button type="submit" name="add" class="btn btn-primary" id="addProductBtn">Add</button>
                                </div>
                            </div>
                    </form>
                    <div class="col-8">
                        <div class="bg-white border rounded-5 p-2 m-3">
                            <form action="./Purchase_Process.php" method="post">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4 border border-white rounded mb-1">
                                        <select class="form-select" id="customer_supplier_id" name="customer_supplier_id" required>
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
                                <hr>

                                <?php
                                $cart_query = "SELECT * FROM cart WHERE `type`='purchase'";
                                $cart_result = mysqli_query($conn, $cart_query);
                                $subtotal = 0;
                                ?>
                                <div class="table-container">
                                    <table class="table table-bordered">
                                        <thead class="bg-dark text-white">
                                            <tr>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Rate</th>
                                                <th>total Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($cart_result)) {
                                                $pc_id = $row['pc_id'];
                                                $p_id = $row['p_id'];
                                                $quantity = $row['quantity'];
                                                $rate = $row['rate'];

                                                $query = "SELECT * FROM product_tbl WHERE pid=$p_id";
                                                $result = mysqli_query($conn, $query);
                                                $row = mysqli_fetch_assoc($result);
                                                $product_name = $row['pname'];
                                            ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $product_name ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $quantity ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $rate ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $total = $rate * $quantity ?>
                                                    </td>
                                                    <td>
                                                        <a class="text-danger" href="Delete_Cart_Item.php?pid=<?php echo $pc_id; ?>&type=purchase"><i class="bi bi-trash-fill"></i></a>
                                                    </td>
                                                    <?php
                                                    $subtotal = $subtotal + $total;
                                                    ?>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <div class="w-100 text-end">
                                        <strong>Total:</strong><span class="" style="margin-right: 285px;"> <?php echo $subtotal ?></span>
                                    </div>
                                    <hr>
                                    <div class="row mt-3">
                                        <div class="col-12 text-end">
                                            <button type="submit" name="purchase" class="btn btn-primary">Purchase</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>