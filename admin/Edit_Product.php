<?php
include('Authentication.php');
require "../connection.php";

@$product_id = $_GET['pid'];
if (isset($_POST['submit'])) {
    $pname = $_POST['product_name'];
    $category_name = $_POST['category_name'];
    $brand_name = $_POST['brand_name'];
    $sales_rate = $_POST['sales_rate'];
    date_default_timezone_set("Asia/Kathmandu");
    $created_date = date("Y-m-d h:i:sa");
    if (isset($_POST['product_status'])) {
        $status = 1;
    } else {
        $status = 0;
    }


    $query = "SELECT b_id FROM brand_tbl WHERE b_name = '$brand_name'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $b_id = $row['b_id'];

    $query = "UPDATE product_tbl SET pname = '$pname', brand_id = '$b_id', sales_rate = '$sales_rate', `status`='$status' WHERE pid = $product_id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        header("location: Display_Product.php");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
$query = "SELECT pname,status,cat_name,b_name,sales_rate from brand_tbl INNER JOIN categories_tbl ON brand_tbl.cat_id=categories_tbl.cat_id INNER JOIN product_tbl on brand_tbl.b_id=product_tbl.brand_id WHERE pid = $product_id";

$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$pname = $row['pname'];
$product_status = $row['status'];
$cat_name = $row['cat_name'];
$brand_name = $row['b_name'];
$sales_rate = $row['sales_rate'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category_name').change(function() {
                var category = $(this).val();

                $.ajax({
                    url: 'Brand.php',
                    method: 'POST',
                    data: {
                        category: category
                    },
                    dataType: 'json',
                    success: function(response) {
                        var options = '<option selected disabled>Select Brand</option>';
                        for (var i = 0; i < response.length; i++) {
                            options += '<option value="' + response[i] + '">' + response[i] + '</option>';
                        }
                        $('#brand_name').html(options);
                    }
                });
            });
        });
    </script>
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Update Product</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i class="bi bi-pencil-square"></i>
                                Update Product
                            </p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Product Name</label>
                                        <input type="text" id="form8Example1" name="product_name" class="form-control" value="<?php echo $pname ?>" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Category Name</label>
                                        <select class="form-select" id="category_name" name="category_name">
                                            <option selected disabled>Select Category</option>
                                            <?php
                                            $query = "SELECT * FROM categories_tbl";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $category = $row['cat_name'];
                                                if ($category == $cat_name) {
                                                    echo "<option value=
                                                    '$category' selected>$category</option>";
                                                } else {
                                                    echo "<option value='$category'>$category</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Brand Name</label>
                                        <select class="form-select" id="brand_name" name="brand_name">
                                            <option selected disabled>Select Brand</option>
                                            <?php
                                            $query = "SELECT b_name FROM brand_tbl";
                                            $result = mysqli_query($conn, $query);
                                            while ($row=mysqli_fetch_assoc($result)) {
                                                $brand = $row["b_name"];
                                                if ($brand == $brand_name) {
                                                    echo "<option value='$brand' selected>$brand</option>";
                                                } else {
                                                    echo "<option value='$brand'>$brand</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Sales Rate</label>
                                        <input type="number" id="form8Example1" name="sales_rate" class="form-control" value="<?php echo $sales_rate ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Product Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="product_status" value="" id="" <?php if ($product_status == 1)
                                                                                                                                        echo "checked"; ?>>
                                            <label class="form-check-label" for="Active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>