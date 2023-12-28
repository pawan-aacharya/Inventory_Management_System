<?php 
session_start();
require('../connection.php');
$id=$_GET['id'];
$readBy=$_SESSION['uname'];
$status=1;
$query="UPDATE `message` SET `status`='$status',`readby`='$readBy' WHERE id='$id'";
$result=mysqli_query($conn,$query);
header("location:Display_Message.php");
?>