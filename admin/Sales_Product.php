<?php
include('Authentication.php');
require "../connection.php";

if (isset($_POST['add'])) {
    $product_name = $_POST['product_name'];
    $quantity = $_POST['quantity'];
    $rate = $_POST['rate'];
    if (empty($product_name)) {
        echo "<script>alert('Please Select Product Name');</script>";
    } elseif ($quantity == 0) {
        echo "<script>alert('Quantity is less than 1');</script>";
    } else {

        $insert_query = "INSERT INTO `cart`(`p_id`, `quantity`, `rate`, `type`) VALUES ('$product_name','$quantity','$rate','sales')";
        $insert_result = mysqli_query($conn, $insert_query);

        if ($insert_result) {
            echo "Data inserted successfully";
        } else {
            echo "Insertion failed" . mysqli_error($conn);
        }
        header('location:Sales_Product.php');
        die;
    }
}

if (isset($_POST['sales'])) {
    $customer_supplier_id = $_POST['customer_supplier_id'];
    $total_amount = 0;
    $query = "SELECT * FROM `cart` WHERE `type`='sales'";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $quantity = $row['quantity'];
        $rate = $row['rate'];
        $amount = $rate * $quantity;
        $total_amount += $amount;
    }

    date_default_timezone_set("Asia/Kathmandu");
    $psdate = date("Y-m-d h:i:sa");

    if (empty($customer_supplier_id)) {
        echo "<script>alert('Please Select Customer Name');window.location.href='Sales_Product.php';</script>";
    } else {
        $insert_query = "INSERT INTO `purchase_sales_tbl`(`csId`, `date`, `transaction_type`, `total_amount`) VALUES ('$customer_supplier_id','$psdate','sale','$total_amount')";
        $insertResult = mysqli_query($conn, $insert_query);

        if ($insertResult) {
            $sql = "SELECT MAX(psId) FROM purchase_sales_tbl";
            $results = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($results);
            $psId = $rows['MAX(psId)'];

            $result = mysqli_query($conn, $query);

            while ($ro = mysqli_fetch_assoc($result)) {
                $quantity = $ro['quantity'];
                $rate = $ro['rate'];
                $product_id = $ro['p_id'];

                $insert_query1 = "INSERT INTO `ps_detail_tbl`( `psId`, `p_id`, `quantity`, `rate`) VALUES ('$psId','$product_id','$quantity','$rate')";
                $inresult = mysqli_query($conn, $insert_query1);

                if (!$inresult) {
                    echo "Error: " . mysqli_error($conn);
                } else {
                }
            }

            $delete_cart = "DELETE FROM cart WHERE `type`='sales'";
            $delete_result = mysqli_query($conn, $delete_cart);
        } else {
            echo "Error: " . mysqli_error($conn);
            die;
        }
        header("location:Transaction_Detail.php?id=$psId");
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#product_id').change(function() {
                var product_id = $(this).val();
                console.log(product_id);

                $.ajax({
                    url: 'remaining_stock.php',

                    method: 'POST',
                    data: {
                        product_id: product_id
                    },

                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        var options = response['stock'];

                        $("#quantity").attr({
                            "max": options,
                            "min": 0
                        });

                        $("#rate").val(response['rate']);

                    },
                });
            });
        });
    </script>

</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col mb-2">
                            <h3 class="fw-bold">Sales Product</h3>
                        </div>
                        <hr>
                    </div>
                    <form id="productForm" action="Sales_Product.php" method="post">
                        <div class="row">
                            <div class="col-4">
                                <div class="bg-white border rounded-5 m-1 p-1">
                                    <div class="mb-3">
                                        <label class="fw-bold" for="product_name" class="form-label">Product Name</label>
                                        <select class="form-select" id="product_id" name="product_name">
                                            <option selected disabled>Select Product</option>
                                            <?php
                                            $query = "SELECT * FROM product_tbl ";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {

                                                $sql = "select count(*) as num from ps_detail_tbl where p_id=$row[pid]";
                                                $res = mysqli_query($conn, $sql);
                                                $r = mysqli_fetch_assoc($res);
                                                $count = $r['num'];
                                                if ($count > 0) { ?>
                                                    <option value="<?php echo $row['pid']; ?>"><?php echo $row['pname'] ?>
                                                    </option>
                                            <?php
                                                } else {
                                                    echo "message";
                                                }
                                            } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label class="fw-bold" for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="0" required>
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
                        <div class="bg-white border rounded-5 p-2 m-3 form">
                            <form action="./Sales_Product.php" method="post">
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-4 border border-white rounded mb-1">
                                        <select class="form-select" id="customer_supplier_id" name="customer_supplier_id" required>
                                            <option selected disabled>Select Customer Name</option>
                                            <?php
                                            $query = "SELECT `csId`,`Name` FROM customer_supplier_tbl WHERE `Type`='customer'";
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
                                $cart_query = "SELECT * FROM cart WHERE `type`='sales'";
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
                                                        <a class="text-danger" href="Delete_Cart_Item.php?pid=<?php echo $pc_id; ?>&type=sales"><i class="bi bi-trash-fill"></i></a>
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
                                            <button type="submit" name="sales" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#salesModal">Sale</button>
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