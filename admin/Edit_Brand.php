<?php
include('Authentication.php');
require "../connection.php";

@$brand_id = $_GET['b_id'];
if (isset($_POST['update'])) {
    $brand_name = $_POST['brand_name'];
    $category_id = $_POST['category_id'];
    if (isset($_POST['brand_status'])) {
        $status = 1;
    } else {
        $status = 0;
    }
    date_default_timezone_set("Asia/Kathmandu");
    $created_date = date("Y-m-d h:i:s");
    $query = "UPDATE `brand_tbl` SET `cat_id`='$category_id',`b_name`='$brand_name',`b_status`='$status',`created_date`='$created_date' WHERE b_id=$brand_id";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script> alert('Brand Updated Successfully'); </script>";
        header('location:Display_Brand.php');
    } else {
        echo "<script> alert('update failed'); </script>";
    }
}
$query = "SELECT * FROM brand_tbl where b_id=$brand_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
    $category_id = $row['cat_id'];
    $brand_name = $row['b_name'];
    $brand_status = $row['b_status'];


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
                    <h5 class="fw-bold">Update Brand</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i
                                    class="bi bi-pencil-square"></i>
                                Update Brand
                            </p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Brand Name</label>
                                        <input type="text" id="form8Example1" name="brand_name" class="form-control"
                                            value="<?php echo $brand_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="form-label fw-bold" for="exampleFormControlSelect1">Select
                                        Category</label>
                                    <select class="form-select" id="exampleFormControlSelect1" name="category_id">
                                        <option disabled>Select Category</option>
                                        <?php
                                        $query = "SELECT * FROM categories_tbl WHERE cat_status='1'";
                                        $result = mysqli_query($conn, $query);
                                        $selectedCategoryId = $row['cat_id'];
                                        
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $categoryId = $row['cat_id'];
                                            $categoryName = $row['cat_name'];
                                            $selected = ($categoryId == $selectedCategoryId) ? "selected" : "";

                                            echo "<option value='$categoryId' $selected>$categoryName</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Brand Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="brand_status" value=""
                                                id="" <?php if ($brand_status == 1)
                                                    echo "checked"; ?>>
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