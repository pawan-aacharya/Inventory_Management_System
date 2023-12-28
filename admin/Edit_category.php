<?php
include('Authentication.php');
require("../connection.php");
@$cat_id = $_GET['cat_id'];
if (isset($_POST['Update'])) {
    $category_name = $_POST['category_name'];
    $unit=$_POST['unit'];
    if (isset($_POST['category_status'])) {
        $status = 1;
    } else {
        $status = 0;
    }
    date_default_timezone_set("Asia/Kathmandu");
    $created_date = date("Y-m-d h:i:sa");
    $query = "UPDATE `categories_tbl` SET `cat_name`='$category_name',`unit`='$unit',`cat_status`=$status,`created_date`='$created_date' WHERE `cat_id`='$cat_id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('Category Updated Successfully.'); window.location.href = 'Display_Category.php';</script>";
      exit;
    } else {
        echo "<script> alert('update failed');window.location.href='Display_Category.php' </script>";
    }
}
$query = "SELECT * FROM categories_tbl WHERE cat_id=$cat_id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $category_name = $row['cat_name'];
    $unit=$row['unit'];
    $category_status = $row['cat_status'];
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
    include("../nav_sidebar.php");
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Update Category</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i
                                    class="bi bi-pencil-square"></i> Update Category</p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Category Name</label>
                                        <input type="text" id="form8Example1" name="category_name" class="form-control"
                                            value="<?php echo $category_name ?>" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Unit</label>
                                        <input type="text" id="form8Example1" name="unit" class="form-control"
                                            value="<?php echo $unit ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Category Status</label>
                                        <div class="form-check">
                                            <!-- <input class="form-check-input" type="checkbox" name="category_status" value="" id=""> -->
                                            <input class="form-check-input" type="checkbox" name="category_status"
                                                value="" id="" <?php if ($category_status == 1)
                                                    echo "checked"; ?>>
                                            <label class="form-check-label" for="Active">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="Update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>