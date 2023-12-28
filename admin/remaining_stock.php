<?php
include('Authentication.php');
include('../connection.php');
$p_id=$_POST['product_id'];
$data[]="";
$inventory_query = "SELECT *, SUM(CASE WHEN ps.`transaction_type` = 'Sale' THEN psd.`quantity` ELSE 0 END) AS total_sold_quantity,SUM(CASE WHEN ps.`transaction_type` = 'Purchase' THEN psd.`quantity` ELSE 0 END) AS total_purchase_quantity FROM ps_detail_tbl psd INNER JOIN purchase_sales_tbl ps on psd.psId=ps.psId WHERE psd.p_id='$p_id'";
                                                $inventory_result = mysqli_query($conn, $inventory_query);
                                                while ($inventory_row = mysqli_fetch_assoc($inventory_result)) {
                                                    $p_id = $inventory_row['p_id'];
                                                    $sold_quantity = $inventory_row['total_sold_quantity'];
                                                    $purchase_quantity = $inventory_row['total_purchase_quantity'];
                                                    $remaining_stock = $purchase_quantity - $sold_quantity;
                                                    
                                                }

                $sql="select * from product_tbl where pid=$p_id";
                $result=mysqli_query($conn,$sql);
                $row=mysqli_fetch_assoc($result);
                $sales_rate=$row['sales_rate'];
               // $remaining_stock=0;
                                                $data["rate"]= $sales_rate;
                                                $data['stock']=$remaining_stock;
                                                echo json_encode($data);
?>