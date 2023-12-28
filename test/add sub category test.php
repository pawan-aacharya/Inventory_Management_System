<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- JavaScript Link -->
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
    </style>
    <script src="../Assets/script.js"></script>
</head>

<body>
    <?php
    require "../connection.php";
    include "../nav_sidebar.php";

    if (isset($_POST['submit'])) {
        $category_name = $_POST['category_name'];
        $sub_category_name = $_POST['sub_category_name'];
        if (!empty($sub_category_name)) {
            $status = isset($_POST['sub_category_status']) ? 1 : 0;
            date_default_timezone_set("Asia/Kathmandu");
            $created_date = date("Y-m-d h:i:sa");
            $query = "INSERT INTO `subcategories_tbl`(`cat_name`, `subcat_name`, `subcat_status`, `created_date`) VALUES ('$category_name','$sub_category_name','$status','$created_date')";
            $result = mysqli_query($conn, $query);
        }
    }
    ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <h5>Add Sub Category</h5>
                <div class="bg-white border rounded-5 p-2 m-3 form">
                    <form action="#" method="post">
                        <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i class="bi bi-plus"></i> Add Sub Category</p>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="exampleFormControlSelect1">Select Category</label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="category_name">
                                        <option selected disabled>Select Categories</option>
                                        <?php
                                        $query = "SELECT * FROM categories_tbl";
                                        $result = mysqli_query($conn, $query);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $category = $row['cat_name'];
                                            echo "<option value='$category'>$category</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">Sub Category Name</label>
                                    <input type="text" id="form8Example1" name="sub_category_name" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example2">Sub Category Status</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="sub_category_status" id="sub_category_status">
                                        <label class="form-check-label" for="sub_category_status">
                                            Active
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                            </div>
                            <div class="col-4"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</body>

</html>