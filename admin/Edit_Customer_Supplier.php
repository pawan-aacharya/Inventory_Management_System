<?php
include('Authentication.php');
require "../connection.php";

@$csId = $_GET['csId'];
echo "$csId";
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $gmail = $_POST['gmail'];
    $type = $_POST['type'];
    print_r($_POST);
    $update_query = "UPDATE `customer_supplier_tbl` SET `Name`='$name',`Address`='$address',`Contact`='$contact',`Email`='$gmail',`Type`='$type' WHERE `csId`='$csId'";
    $result = mysqli_query($conn, $update_query);
    if ($result) {
        header("Location: Display_Customer_Supplier.php");
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
$select_query = "SELECT * FROM customer_supplier_tbl WHERE csId ='$csId'";
$result = mysqli_query($conn, $select_query);
while ($row = mysqli_fetch_assoc($result)) {
    $csId = $row['csId'];
    $name = $row['Name'];
    $address = $row['Address'];
    $contact = $row['Contact'];
    $gmail = $row['Email'];
    $type = $row['Type'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboad</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus {
            box-shadow: none !important;
            border-color: none !important;
        }
    </style>
    <script src="../Assets/script.js"></script>
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-4 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Edit Customer/Supplier</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3 form">
                        <form action="#" method="post">
                        <p class="p-2 mb-2 fw-bold text-center border bg-dark text-white"><i
                                    class="bi bi-pencil-square"></i>
                                Update Customer Supplier
                            </p>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="name">Name</label>
                                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $name; ?>" required>
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="address">Address</label>
                                        <input type="text" id="address" name="address" class="form-control" value="<?php echo $address; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="contact">Contact</label>
                                        <input type="text" id="contact" name="contact" class="form-control" value="<?php echo $contact; ?>">
                                    </div>
                                </div>
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="gmail">Gmail</label>
                                        <input type="email" id="gmail" name="gmail" class="form-control" value="<?php echo $gmail; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 mb-3">
                                    <div class="">
                                        <label class="form-label fw-bold" for="type">Type</label>
                                        <select class="form-select" id="type" name="type" required>
                                            <option value="Customer" <?php if ($type === 'Customer')
                                                                            echo 'selected'; ?>>Customer</option>
                                            <option value="Supplier" <?php if ($type === 'Supplier')
                                                                            echo 'selected'; ?>>Supplier</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="update" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>