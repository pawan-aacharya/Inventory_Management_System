<?php
include('Authentication.php');
require('../connection.php');
@$brand_id = $_GET['b_id'];

$query = "SELECT COUNT(*) AS count FROM product_tbl WHERE brand_id=$brand_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if ($count > 0) {
    echo "<script>alert('Cannot delete brand. There are existing products.'); window.location.href = 'Display_Brand.php';</script>";
    exit;
}

$query = "DELETE FROM brand_tbl WHERE b_id=$brand_id";
$result = mysqli_query($conn, $query);

if ($result) {
    header("location: Display_Brand.php");
} else {
    echo "Failed to delete category: " . mysqli_error($conn);
}

mysqli_close($conn);
?>