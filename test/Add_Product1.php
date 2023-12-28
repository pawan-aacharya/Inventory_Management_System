<?php
require "../connection.php";

if (isset($_POST['submit'])) {
    $product_name = $_POST['product_name'];
    $category_name = $_POST['category_name'];
    $subcategory_name = $_POST['subcategory_name'];
    $brand_name = $_POST['brand_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    date_default_timezone_set("Asia/Kathmandu");
    $created_date = date("Y-m-d h:i:sa");
    if (isset($_POST['product_status'])) {
        $status = 1;
    } else {
        $status = 0;
    }
    $query = "INSERT INTO `product_tbl`(`p_name`, `cat_name`, `subcat_name`, `brand_name`, `price`, `quantity`, `created_date`, `status`) VALUES ('$product_name','$category_name','$subcategory_name','$brand_name','$price','$quantity','$created_date','$status')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header("location:Display_Product.php");
    }
}
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

                    <h5>Add Product</h5>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i class="bi bi-plus"></i>
                                Add Product
                            </p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Product Name</label>
                                        <input type="text" id="form8Example1" name="product_name" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Category Name</label>
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            name="category_name">
                                            <option selected disabled>Select Categories</option>
                                            <?php
                                            $query = "SELECT * FROM categories_tbl WHERE cat_status='1'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $category = $row['cat_name'];
                                                echo "<option value='$category'>$category</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Subcategory Name</label>
                                        <select class="form-control" id="exampleFormControlSelect1"
                                            name="subcategory_name">
                                            <option selected disabled>Select Subcategory</option>
                                            <?php
                                            $query = "SELECT * FROM subcategories_tbl WHERE subcat_status='1'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $sub_category = $row['subcat_name'];
                                                echo "<option value='$sub_category'>$sub_category</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Brand Name</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="brand_name">
                                            <option selected disabled>Select Brand</option>
                                            <?php
                                            $query = "SELECT * FROM brand_tbl WHERE b_status='1'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $brand = $row['b_name'];
                                                echo "<option value='$brand'>$brand</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Price<span>(per
                                                unit)</span></label>
                                        <input type="number" id="form8Example1" name="price" class="form-control"
                                            required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold"
                                            for="form8Example1">Stock<span>(unit)</span></label>
                                        <input type="number" id="form8Example1" name="quantity" class="form-control"
                                            required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Product Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="product_status"
                                                value="" id="">
                                            <label class="form-check-label" for="Active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>