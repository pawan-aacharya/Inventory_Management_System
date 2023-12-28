<?php
include('Authentication.php');
require '../connection.php';
@$product_id=$_GET['pid'];

$query = "SELECT COUNT(*) AS count FROM ps_detail_tbl WHERE p_id=$product_id";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);
$count = $row['count'];

if ($count > 0) {
    echo "<script>alert('Cannot delete product. You can inactive it.'); window.location.href = 'Display_Product.php';</script>";
    exit;
}

$query="DELETE FROM product_tbl WHERE pid='$product_id'";
$result=mysqli_query($conn,$query);
if($result){
    echo "<script> alert('deleted successfully'); </script>";
    header('location:Display_Product.php');
}
?>