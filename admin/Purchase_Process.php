<?php
include('Authentication.php');
require('../connection.php');

if (isset($_POST['purchase'])) {
    $customer_supplier_id = $_POST['customer_supplier_id'];
    //print_r($_POST);
        $total_amount = 0;
        $query = "SELECT * FROM `cart` WHERE `type`='purchase'";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $quantity = $row['quantity'];
            $rate = $row['rate'];
            $amount = $rate * $quantity;
            $total_amount += $amount;
        }
        date_default_timezone_set("Asia/Kathmandu");
        $psdate = date("Y-m-d h:i:sa");

        if(empty($customer_supplier_id)){
            echo "<script>alert('Please Select Supplier Name');window.location.href='Purchase_Product.php';</script>";
        }
        else{

        $insert_query = "INSERT INTO `purchase_sales_tbl`(`csId`, `date`, `transaction_type`, `total_amount`) VALUES ('$customer_supplier_id','$psdate','purchase','$total_amount')";
        $insertResult = mysqli_query($conn, $insert_query);
        if ($insertResult) {
           // $InsertedId = mysqli_insert_id($conn); 
            $sql = "SELECT MAX(psId)
        FROM purchase_sales_tbl";
            $results = mysqli_query($conn, $sql);
            $rows = mysqli_fetch_assoc($results);
            $psId = $rows['MAX(psId)'];

            //echo "success";

            $result = mysqli_query($conn, $query);

            while ($ro = mysqli_fetch_assoc($result)) {

                $quantity = $ro['quantity'];
                $rate = $ro['rate'];
                $product_id = $ro['p_id'];

                $insert_query1 = "INSERT INTO `ps_detail_tbl`( `psId`, `p_id`, `quantity`, `rate`) VALUES ('$psId','$product_id','$quantity','$rate')";
                $inresult = mysqli_query($conn, $insert_query1);
                if ($inresult) {
                    $chk = true;
                } else {
                    $chk = false;
                    echo "error" . mysqli_error($conn);
                }
            }
            if ($chk == true) {

                $delete_cart = "DELETE FROM cart WHERE `type`='purchase'";
                $delete_result = mysqli_query($conn, $delete_cart);
            }
        }
        header("location:Transaction_Detail.php?id=$psId");
    }
}

