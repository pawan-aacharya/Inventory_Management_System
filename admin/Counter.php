<?php
// include('Authentication.php');
require('../connection.php');

// Count total categories
$query_category = "SELECT COUNT(cat_id) AS total_categories FROM categories_tbl";
$result_category = mysqli_query($conn, $query_category);
$row_category = mysqli_fetch_assoc($result_category);
$total_categories = $row_category['total_categories'];

// Count total brands
$query_brand = "SELECT COUNT(b_id) AS total_brands FROM brand_tbl";
$result_brand = mysqli_query($conn, $query_brand);
$row_brand = mysqli_fetch_assoc($result_brand);
$total_brands = $row_brand['total_brands'];

// Count total suppliers
$query_supplier = "SELECT COUNT(csId) AS total_suppliers FROM customer_supplier_tbl WHERE `Type`='Supplier'";
$result_supplier = mysqli_query($conn, $query_supplier);
$row_supplier = mysqli_fetch_assoc($result_supplier);
$total_suppliers = $row_supplier['total_suppliers'];

// Count total customers
$query_customer = "SELECT COUNT(csId) AS total_customers FROM customer_supplier_tbl WHERE `Type`='Customer'";
$result_customer = mysqli_query($conn, $query_customer);
$row_customer = mysqli_fetch_assoc($result_customer);
$total_customers = $row_customer['total_customers'];

// Count total products
$query_product = "SELECT COUNT(pid) AS total_products FROM product_tbl";
$result_product = mysqli_query($conn, $query_product);
$row_product = mysqli_fetch_assoc($result_product);
$total_products = $row_product['total_products'];

// total purchase
$query_purchase="SELECT SUM(total_amount) AS total_amount
FROM purchase_sales_tbl
WHERE transaction_type = 'purchase'";
$purchase_result=mysqli_query($conn,$query_purchase);
$row_purchase=mysqli_fetch_assoc($purchase_result);
$total_purchase=$row_purchase['total_amount'];

// total sales
$query_sale="SELECT SUM(total_amount) AS total_amount
FROM purchase_sales_tbl
WHERE transaction_type = 'sale'";
$sale_result=mysqli_query($conn,$query_sale);
$row_sale=mysqli_fetch_assoc($sale_result);
$total_sales=$row_sale['total_amount'];


// Stock detail
$stock_query="SELECT
p_id,
SUM(CASE WHEN transaction_type = 'purchase' THEN quantity ELSE 0 END) -
SUM(CASE WHEN transaction_type = 'sale' THEN quantity ELSE 0 END) AS remaining_quantity
FROM
ps_detail_tbl
INNER JOIN
purchase_sales_tbl ON purchase_sales_tbl.psId = ps_detail_tbl.psId
GROUP BY
p_id";
$stock_result=mysqli_query($conn,$stock_query);
$stock_result = mysqli_query($conn, $stock_query);

// Initialize a counter for low stock products
$low_stock_count = 0;
$out_of_stock=0;

while ($stock_row = mysqli_fetch_assoc($stock_result)) {
    // Check if remaining_quantity is less than 10
    if ($stock_row['remaining_quantity'] < 10) {
        // Increment the counter
        $low_stock_count++;
    }
    if ($stock_row['remaining_quantity'] < 1) {
        // Increment the counter
        $out_of_stock++;
    }

}
?>