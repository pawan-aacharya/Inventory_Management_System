<?php
include('Authentication.php');
require "../connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">
</head>

<body id="body">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- navbar toggler -->
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
            </button>

            <!-- end navbar toggler -->
            <a class="navbar-brand fw-bold text-uppercase me-auto" href="#">Inventory Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- <form class="d-flex ms-auto">
          <div class="input-group my-2 my-lg-0">
            <input type="text" class="form-control" aria-label="Recipient's username" aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
          </div>
        </form> -->
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-fill"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="Profile.php">Profile</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="LogOut.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end nav -->
    <div class="container-fluid mt-5 pt-4 w-75">
        <div class="print mt-2 mb-2">
            <button class="btn" onclick="printPage();" id="print" name="print"><i class="bi bi-printer-fill"></i>Print</button>
        </div>
        <div class="row">
            <div class="col bg-white border rounded-5 p-2 m-3">
                <div class="table-responsive" id="data">
                    <?php
                    $InsertedId = $_GET['id'];
                    $query = "SELECT * FROM ps_detail_tbl psd INNER JOIN purchase_sales_tbl ps ON psd.psId=ps.psId INNER JOIN product_tbl ON psd.p_id=product_tbl.pid WHERE ps.psId=$InsertedId";

                    $result = mysqli_query($conn, $query);

                    ?>
                    <table class="table table">
                        <h4 class="fw-bold">
                            Transaction Detail
                            </h3>
                            <hr>
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Client Name</th>
                                    <th>Product Name</th>
                                    <th>Product Quantity</th>
                                    <th>Rate <span>(per unit)</span></th>
                                    <th>Total Amount</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $subtotal=0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $csId = $row['csId'];
                                    $customerQuery = "SELECT Name FROM customer_supplier_tbl WHERE csId='$csId'";
                                    $customerResult = mysqli_query($conn, $customerQuery);
                                    $customerRow = mysqli_fetch_assoc($customerResult);
                                    $total_amount=$row['rate'] * $row['quantity'];
                                    $subtotal+=$total_amount;
                                ?>
                                    <tr>
                                        <td><?php echo $row['psdId']; ?></td>
                                        <td><?php echo $customerRow['Name']; ?></td>
                                        <td><?php echo $row['pname'] ?></td>
                                        <td><?php echo $row['quantity']; ?></td>
                                        <td><?php echo $row['rate']; ?></td>
                                        <td><?php echo $total_amount ?></td>
                                        <td><?php echo $row['date'] ?></td>
                                    </tr>
                                   
                                <?php } ?>
                                <tr>
                                        <th colspan="4"></th>
                                        <th colspan="">Total Amount</th>
                                        <th><?=$subtotal ?></th>
                                    </tr>
                            </tbody>
                    </table>
                </div>
                <div class="text-end">
                    <a href="./Manage_Inventory.php"><button class="btn btn-primary">OK</button></a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/JavaScript">
        function printPage(){
        var body=document.getElementById('body').innerHTML;
        var data=document.getElementById('data').innerHTML;
        document.getElementById('body').innerHTML=data;
        window.print();
        document.getElementById('body').innerHTML=body;
    }
    </script>
</body>

</html>