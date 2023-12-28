<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['uname']) && isset($_SESSION['role'])) {
    header("Location: ../Index.php");
    exit;
}


@$uid = $_GET['uid'];
if (isset($_POST['update'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $query = "UPDATE `user_tbl` SET `username`='$username',`role`='$role',`password`='$password' WHERE `user_id`='$uid'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<script>alert('User updated successfully!!!');window.location='./profile.php'</script>";
    } else {
        mysqli_error($conn);
    }
}

// Fetch user information from the database
$sql = "SELECT * FROM user_tbl where user_id=$uid";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$username = $row['username'];
$role = $row['role'];
$password = $row['password'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="../Assets/Style1.css">
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="heading mb-4">
                        <h4 class="fw-bold">Update User</h4>
                    </div>
                    <hr>
                    <?php

                    ?>
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="username" class="form-label fw-bold">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="<?php echo $username ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-bold">Password</label>
                                    <input type="text" class="form-control" id="password" name="password" value="<?= $password ?>" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class=" mb-3">
                                    <label class="form-label fw-bold" for="role">Role</label>
                                    <select class="form-select" id="role" name="role">
                                        <option selected disabled>Select Role</option>
                                        <option value="admin" <?php if ($role == 'admin') echo 'selected' ?>>Admin</option>
                                        <option value="staff" <?php if ($role == 'staff') echo 'selected' ?>>staff</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary" name="update">UPDATE</button>
                    </form>
                </div>
            </div>
    </main>
    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>