<?php
include('Authentication.php');
require('../connection.php');
@$csId = $_GET['csId'];

$query = "DELETE FROM customer_supplier_tbl WHERE csId=$csId";
$result = mysqli_query($conn, $query);

if ($result) {
    header("location: Display_Customer_Supplier.php");
} else {
    echo "Failed to delete category: " . mysqli_error($conn);
}

mysqli_close($conn);
?>