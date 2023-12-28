<?php
session_start();
require '../connection.php';
if (isset($_POST['login'])) {
    $uname = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user_tbl WHERE username='$uname' AND `password`='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $role=$row['role'];

        $_SESSION['role']=$role;
        $_SESSION['uname'] = $uname;
        $_SESSION['pass'] = $password;

        header("location:./Dashboard.php");
    } else {
        echo "<script>alert('you have entered incorrect password');window.location='login.php'</script>";
        exit();
    }
}
?>
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

    <link rel="stylesheet" href="../Assets/LoginStyle.css">
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
    <div class="title">
        <h3 class="ms-auto fw-bold">Inventory Management System</h3>
    </div>
    <form action="" method="post">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 main">
                    <div class="form-heading text-center">
                        <h6 class="fw-bold">Login</h6>
                    </div>
                    <div class="form-control mb-3">
                        <label for="username" class="form-label fw-bold">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="" placeholder="Enter your username" require>
                    </div>
                    <div class="form-control mb-3">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" require>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary btn-block mt-2">Login</button>
                </div>
                <div class="col-4"></div>
            </div>
        </div>
    </form>
</body>

</html>