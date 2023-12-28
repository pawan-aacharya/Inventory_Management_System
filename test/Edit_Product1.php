<?php
require "../connection.php";
@$product_id = $_GET['p_id'];
if (isset($_POST['update'])) {
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
    $query = "UPDATE `product_tbl` SET `p_name`='$product_name',`cat_name`='$category_name',`subcat_name`='$subcategory_name',`brand_name`='$brand_name',`price`='$price',`quantity`='$quantity',`created_date`='$created_date',`status`='$status' WHERE p_id=$product_id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        header('location:Display_Product.php');
    } else {
        echo "update failed";
    }
}
$query = "SELECT * FROM product_tbl WHERE p_id=$product_id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $product_name = $row['p_name'];
    $category_name = $row['cat_name'];
    $subcategory_name = $row['subcat_name'];
    $brand_name = $row['brand_name'];
    $price = $row['price'];
    $quantity = $row['quantity'];
    $created_date = $row['created_date'];
    $product_status = $row['status'];
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
    <main class="mt-2 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5>Update Product</h5>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i
                                    class="bi bi-pencil-square"></i>
                                Edit
                            </p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Product Name</label>
                                        <input type="text" id="form8Example1" name="product_name" class="form-control"
                                            value="<?php echo $product_name ?>" required>
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
                                                $selected = ($category = $category_name) ? 'selected' : '';
                                                echo "<option value='$category'$selected>$category</option>";
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
                                                $selected = ($sub_category = $subcategory_name) ? 'selected' : '';
                                                echo "<option value='$sub_category'$selected>$sub_category</option>";
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
                                                $selected = ($brand = $brand_name) ? 'selected' : '';
                                                echo "<option value='$brand'$selected>$brand</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Price<small>(per unit)</small></label>
                                        <input type="number" id="form8Example1" name="price" class="form-control"
                                            value="<?php echo $price ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Quantity<span>(unit)</span></label>
                                        <input type="text" id="form8Example1" name="quantity" class="form-control"
                                            value="<?php echo $quantity ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Product Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="product_status" <?php if ($product_status == 1)
                                                echo "checked"; ?> id="">
                                            <label class="form-check-label" for="Active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>