<?php 
include('../connection.php');
@$uid=$_GET['uid'];
$query="DELETE FROM user_tbl WHERE user_id=$uid";
$result=mysqli_query($conn,$query);
if($result){
    echo "<script>alert('user deleted successfully!!!');window.location='./profile.php'</script>";
}
?>