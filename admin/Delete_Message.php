<?php
include('Authentication.php');
require '../connection.php';
@$id=$_GET['id'];
$status=$_GET['status'];
$query="DELETE FROM `message` WHERE id='$id'";
$result=mysqli_query($conn,$query);
if($result){

    echo "<script> alert('deleted successfully'); </script>";
}
else{
    echo "error".mysqli_error($conn);
}
if($status==0){
    header("location:Display_Message.php");    
}
else{
    header("location:Read_Message.php");
}

?>