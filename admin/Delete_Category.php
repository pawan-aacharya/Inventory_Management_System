<?php
include('Authentication.php');
require('../connection.php');
@$cat_id = $_GET['cat_id'];

$query = "SELECT COUNT(*) AS count FROM brand_tbl WHERE cat_id=$cat_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if ($count > 0) {
    echo "<script>alert('Cannot delete category. There are existing brands.'); window.location.href = 'Display_Category.php';</script>";
    exit;
}

$query = "DELETE FROM categories_tbl WHERE cat_id=$cat_id";
$result = mysqli_query($conn, $query);

if ($result) {
    header("location: Display_Category.php");
} else {
    echo "Failed to delete category: " . mysqli_error($conn);
}

mysqli_close($conn);
?>