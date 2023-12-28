<?php
include('Authentication.php');
require('../connection.php');
$type=$_GET['type'];
$pc_id=$_GET['pid'];
$query="DELETE FROM `cart` WHERE `pc_id`='$pc_id'";
$result=mysqli_query($conn,$query);
if($result){
    echo "cart item deleted successfully";
}else{
    echo "error".mysqli_error($conn);
}
if($type=='sales'){
header("location:Sales_Product.php");
}
else{
    header("location:Purchase_Product.php");
}
?>