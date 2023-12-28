<?php 
include('Authentication.php');
require '../connection.php';

if(isset($_POST['category'])){
    $category = $_POST['category'];

    $query = "SELECT b_name FROM brand_tbl WHERE cat_id = (SELECT cat_id FROM categories_tbl WHERE cat_name = '$category') AND b_status = '1'";
    $result = mysqli_query($conn, $query);

    $brand = array();
    while($row = mysqli_fetch_assoc($result)){
        $brand[] = $row['b_name'];
    }

    echo json_encode($brand);
}
?>
