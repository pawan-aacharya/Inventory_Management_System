<?php
require "../connection.php";

@$subcat_id = $_GET['subcat_id'];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update'])) {
    $category_id=$_POST['category_id'];
    $sub_category_name = $_POST['sub_category_name'];
    if (!empty($sub_category_name)) {
        if (isset($_POST['sub_category_status'])) {
            $status = 1;
        } else {
            $status = 0;
        }
        date_default_timezone_set("Asia/Kathmandu");
        $created_date = date("Y-m-d h:i:sa");
        $query = "UPDATE `subcategories_tbl` SET `cat_id`='$category_id',`subcat_name`='$sub_category_name',`subcat_status`='$status',`created_date`='$created_date' WHERE `subcat_id`=$subcat_id";
        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location: Display_Sub_Category.php");
        }
    }
}
$query = "SELECT * FROM subcategories_tbl WHERE subcat_id=$subcat_id";
$result = mysqli_query($conn, $query);
while ($row = mysqli_fetch_assoc($result)) {
    $category_id=$row['cat_id'];
    $sub_category_name = $row['subcat_name'];
    $subcategory_status = $row['subcat_status'];
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
    <!-- JavaScript Link -->
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
                    <h5>Update Sub Category</h5>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="POST">
                            <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i
                                    class="bi bi-pencil-square"></i>
                                Update Sub Category</p>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="exampleFormControlSelect1">Select
                                            Category Id</label>
                                        <select class="form-control" id="exampleFormControlSelect1" name="category_id"
                                            value="">
                                            <option selected disabled>Select Categories</option>
                                            <?php
                                            $query = "SELECT * FROM categories_tbl WHERE cat_status='1'";
                                            $result = mysqli_query($conn, $query);
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $category_id = $row['cat_id'];
                                                $category_name=$row['cat_name'];
                                                $selected = ($category_id == $category_id) ? 'selected' : ''; // Check if the category matches the selected category_name
                                                echo "<option value='$category_id $category_name' $selected>$category_id $category_name</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example1">Sub Category Name</label>
                                        <input type="text" id="form8Example1" name="sub_category_name"
                                            class="form-control" value="<?php echo $sub_category_name ?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="form8Example2">Sub Category
                                            Status</label>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="sub_category_status"
                                                id="subcategory_status" <?php if ($subcategory_status == 1)
                                                    echo "checked"; ?>>
                                            <label class="form-check-label" for="sub_category_status">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4"> <button type="submit" name="update"
                                        class="btn btn-primary">Update</button>
                                </div>
                                <div class="col-4">
                                </div>
                                <div class="col-4"></div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>