<?php 
$server="localhost";
$username="root";
$password="";
$database="ims";
$conn=mysqli_connect($server,$username,$password,$database);
if($conn){
    
}
else{
    echo "<script> alert('connected failed'); </script>";
}
?>