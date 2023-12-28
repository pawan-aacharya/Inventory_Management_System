<?php
include('Authentication.php');
require '../connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Retrieve data from the form
    $productId = $_POST['product_id'];
    $productName = $_POST['product_name'];
    $productPrice = $_POST['product_price'];
    $quantity = $_POST['quantity'];
 
    $existingCartItemQuery = "SELECT * FROM cart WHERE product_id = '$productId'";
    $existingCartItemResult = mysqli_query($conn, $existingCartItemQuery);
    $existingCartItem = mysqli_fetch_assoc($existingCartItemResult);

    $productQuantityQuery = "SELECT quantity FROM product_tbl WHERE p_id = '$productId'";
    $productQuantityResult = mysqli_query($conn, $productQuantityQuery);
    $productQuantityRow = mysqli_fetch_assoc($productQuantityResult);
    $availableQuantity = $productQuantityRow['quantity'];

    if ($existingCartItem) {
        $existingQuantity = $existingCartItem['quantity'];

        $newQuantity = $existingQuantity + $quantity;

        if ($newQuantity <= $availableQuantity) {
            $updateCartItemQuery = "UPDATE cart SET quantity = '$newQuantity' WHERE product_id = '$productId'";
            if (mysqli_query($conn, $updateCartItemQuery)) {
                echo "<script>alert('Product added to cart successfully.'); window.location.href = 'Cart.php';</script>";
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Quantity exceeds available stock.');</script>";
        }
    } else {
        if ($quantity <= $availableQuantity) {
            $sql = "INSERT INTO cart (product_id, quantity, price) VALUES ('$productId', '$quantity', '$productPrice')";
            if (mysqli_query($conn, $sql)) {
                echo "<script>alert('Product added to cart successfully.'); window.location.href = 'Cart.php';</script>";
                exit;
            } else {
                echo "Error: " . mysqli_error($conn);
            }
        } else {
            echo "<script>alert('Quantity exceeds available stock.');</script>";
        }
    }
    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Admin Dashboard</title>
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

        body {
            background-color: #F0F0F0;
        }
    </style>
    <script src="../Assets/script.js"></script>
</head>

<body>
    <?php
    include '../nav_sidebar.php';
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="heading">
                        <h3>Search Product</h3>
                    </div>
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-4 border border-white rounded p-3" style="background-color: #B9B9B9;">
                            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form-inline my-3">
                                <div class="input-group">
                                    <input type="text" name="search" id="form1" class="form-control" />
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-primary" name="submit">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-4"></div>
                    </div>

                    <?php
                    require '../connection.php';
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

                        if (!empty($_POST['search'])) {

                            $search = $_POST['search'];
                            $sanitizedSearch = filter_var($search, FILTER_SANITIZE_STRING);

                            $sql = "SELECT * FROM product_tbl
                INNER JOIN categories_tbl ON product_tbl.cat_id = categories_tbl.cat_id
                INNER JOIN subcategories_tbl ON product_tbl.subcat_id = subcategories_tbl.subcat_id
                INNER JOIN brand_tbl ON product_tbl.b_id = brand_tbl.b_id
                WHERE (product_tbl.p_name LIKE '%$sanitizedSearch%'
                OR categories_tbl.cat_name LIKE '%$sanitizedSearch%'
                OR subcategories_tbl.subcat_name LIKE '%$sanitizedSearch%'
                OR brand_tbl.b_name LIKE '%$sanitizedSearch%')
                AND product_tbl.quantity > 0";

                            $result = mysqli_query($conn, $sql);
                            $i = 0;

                            if (mysqli_num_rows($result) > 0) {
                                echo "<hr>";
                                echo "<p class='fw-bold'>Product Search Results against <b class='text-primary'>#$sanitizedSearch </b>keyword</p>";
                                echo "<hr>";
                                echo "<table class='table table-bordered'>";
                                echo "<thead class='bg-dark text-white'>";
                                echo "<tr>";
                                echo "<th>S.N</th>";
                                echo "<th>Product Name</th>";
                                echo "<th>Category</th>";
                                echo "<th>Subcategory</th>";
                                echo "<th>Brand</th>";
                                echo "<th>Price<small>(per piece)</small></th>";
                                echo "<th>Stock</th>";
                                echo "<th>Created Date</th>";
                                echo "<th>Quantity</th>";
                                echo "<th>Action</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";

                                while ($row = mysqli_fetch_assoc($result)) {
                                    $productId = $row['p_id'];

                                    $quantityQuery = "SELECT MAX(quantity) AS max_quantity FROM product_tbl WHERE p_id = '$productId'";
                                    $quantityResult = mysqli_query($conn, $quantityQuery);
                                    $quantityRow = mysqli_fetch_assoc($quantityResult);
                                    $maxQuantity = $quantityRow['max_quantity'];
                                    echo "<tr>";
                                    echo "<th>" . ++$i . "</th>";
                                    echo "<td>" . $row['p_name'] . "</td>";
                                    echo "<td>" . $row['cat_name'] . "</td>";
                                    echo "<td>" . $row['subcat_name'] . "</td>";
                                    echo "<td>" . $row['b_name'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" .$row['quantity']."</td>";
                                    echo "<td>" .$row['created_date']."</td>";
                                    echo "<td>";
                                    echo "<form action='' method='POST'>";
                                    echo "<input type='hidden' name='product_id' value='" . $row['p_id'] . "'>";
                                    echo "<input type='hidden' name='product_name' value='" . $row['p_name'] . "'>";
                                    echo "<input type='hidden' name='product_price' value='" . $row['price'] . "'>";
                                    echo "<input type='number' name='quantity' class='form-control' style='width: 75px;' value='1' min='1' max='" . $maxQuantity . "'>";
                                    echo "</td>";
                                    echo "<td><button type='submit' class='btn btn-primary' name='add_to_cart'><i class='bi bi-plus'></i> Add to Cart</button></td>";
                                    echo "</form>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";
                            } else {
                                echo "<h3>No results found.</h3>";
                            }

                            mysqli_close($conn);
                        } else {
                            echo "<h3>Please enter a search query.</h3>";
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
</body>

</html>