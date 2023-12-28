<?php
include('Authentication.php');
require "../connection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    $query = "SELECT * FROM product_tbl WHERE created_date BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($conn, $query);
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
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="heading">
                        <h4 class="mb-4">Stock Report from different dates</h4>
                    </div>
                    <hr>
                    <form action="" method="post" class="border border-white rounded p-3"
                        style="background-color: #B9B9B9;">
                        <div class="row mx-5">
                            <div class="col-6 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">Start Date</label>
                                    <input type="date" id="form8Example1" name="start_date" class="form-control"
                                        required>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="">
                                    <label class="form-label fw-bold" for="form8Example1">End Date</label>
                                    <input type="date" id="form8Example1" name="end_date" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary" name="search">Search
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </form>
                    <hr>
                    <?php
                    if (isset($result)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "<h3>Search Results:</h3>";
                            echo "<table class='table table-bordered'>";
                            echo "<thead class='bg-dark text-white'>";
                            echo "<tr>";
                            echo "<th>S.N.</th>";
                            echo "<th>Product ID</th>";
                            echo "<th>Product Name</th>";
                            echo "<th>Stock Quantity</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>"; 
                            $i=0;
                    
                            while ($row = mysqli_fetch_assoc($result)) {
                                $product_id = $row['p_id'];
                                $product_name = $row['p_name'];
                                $quantity = $row['quantity'];
                                echo "<tr>";
                                echo "<TH>" . ++$i . "</tH>";
                                echo "<td>" . $product_id . "</td>";
                                echo "<td>" . $product_name . "</td>";
                                echo "<td>" . $quantity . "</td>";
                                echo "</tr>";
                            }

                            echo "</tbody>"; 
                            echo "</table>";
                        } else {
                            echo "<h4>No products found between the given dates.</h4>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</body>

</html>