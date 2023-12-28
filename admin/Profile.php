<?php
session_start();
require '../connection.php';

if (!isset($_SESSION['uname']) && isset($_SESSION['role'])) {
    header("Location: ../Index.php");
    exit;
}

// Fetch user information from the database
$username = $_SESSION['uname'];
$role = $_SESSION['role'];
$sql = "SELECT * FROM user_tbl WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$cPassword = $row['password'];
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
                        <h4 class="fw-bold">User Profile</h4>
                    </div>
                    <hr>
                    <div class="row bg-white border rounded-5 p-2 m-3">
                        <div class="col-6">
                            <h5>Hello,<strong> <?php echo $_SESSION['uname']; ?></strong></h5>
                            <hr>
                            <table class="table table-bordered">
                                <tr>
                                    <th>User Id:</th>
                                    <td><?php echo $row['user_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Username:</th>
                                    <td><?php echo $row['username']; ?></td>
                                </tr>
                                <tr>
                                    <th>Role:</th>
                                    <td><?php echo $role ?></td>
                                </tr>
                            </table>
                            <!-- <button type="submit" class="btn btn-primary" name="change_password" data-bs-toggle="modal" data-bs-target="#exampleModal">Change Password</button> -->
                        </div>
                        <?php

                        if ($_SESSION['role'] == 'admin') {
                        ?>
                            <div class="col-6">
                                <h5>Add User</h5>
                                <hr>
                                <?php
                                if (isset($_POST['addUser'])) {
                                    $username = $_POST['username'];
                                    $password = $_POST['password'];
                                    $role = $_POST['role'];
                                    $query = "INSERT INTO user_tbl(`username`,`role`,`password`) VALUES('$username','$role','$password')";
                                    $result = mysqli_query($conn, $query);
                                    if ($result) {
                                        echo "<script>alert('added user successfully');window.location='./profile.php'</script>";
                                    } else {
                                        mysqli_error($conn);
                                    }
                                }
                                ?>
                                <form action="" method="POST">
                                    <div class="mb-3">
                                        <label for="username" class="form-label fw-bold">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label fw-bold">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="form-label fw-bold" for="role">Role</label>
                                        <select class="form-select" id="role" name="role">
                                            <option selected disabled>Select Role</option>
                                            <option value="admin">Admin</option>
                                            <option value="staff">Staff</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="addUser">Add User</button>
                                </form>
                            </div>
                        <?php } ?>
                    </div>

                    <?php if ($_SESSION['role'] == 'admin') { ?>
                        <div class="bg-white border rounded-5 p-2 m-3">
                            <table class="table m-2" id="myTable">
                                <thead class="bg-dark text-white">
                                    <tr>
                                        <th scope="col">S.N</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Role</th>
                                        <!-- <th scope="col">Password</th> -->
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $query = "select * from user_tbl";
                                    $result = mysqli_query($conn, $query);
                                    $i = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $uid = $row['user_id'];
                                        $username = $row['username'];
                                        $role = $row['role'];
                                        $password = $row['password'];
                                    ?>
                                        <tr>
                                            <th scope="row">
                                                <?php echo ++$i ?>
                                            </th>
                                            <td>
                                                <?php echo $username ?>
                                            </td>
                                            <td>
                                                <?php echo $role ?>
                                            </td>
                                            <!-- <td>
                                                <?php echo $password ?>
                                            </td> -->
                                            <td>
                                                <a href="Edit_User.php?uid=<?php echo $uid ?>"><button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                                <a href="Delete_User.php?uid=<?php echo $uid ?>"><button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?');"><i class="bi bi-trash-fill"></i></button></a>
                                            </td>
                                        </tr>
                                </tbody>
                            <?php } ?>
                            </table>
                        </div>
                    <?php } ?>
                    <!-- ===========modal============ -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="cpassword" class="form-label fw-bold">Current Password</label>
                                            <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newpassword" class="form-label fw-bold">New Password</label>
                                            <input type="password" class="form-control" id="new" name="newpassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmnew" class="form-label fw-bold">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmnew" name="confirmnew" required>
                                        </div>
                                        <button type="submit" name="change_password" class="btn btn-primary">Change Password</button>
                                    </form>
                                </div>
                                <!-- <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">change</button>
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <?php
                    // print_r($cPassword);
                    if (isset($_POST['change_password'])) {
                        $currentPassword = $_POST['cpassword'];
                        $newPassword = $_POST['newpassword'];
                        $confirmPassword = $_POST['confirmnew'];

                        if ($cPassword === $currentPassword) {

                            if ($newPassword == $confirmPassword) {


                                $updateSql = "UPDATE user_tbl SET `password` = '$newPassword' WHERE username = '$username'";
                                $updateResult = mysqli_query($conn, $updateSql);

                                if ($updateResult) {
                                    echo "<script>alert('Password changed successfully');window.location='./profile.php'</script>";
                                } else {
                                    echo "Error: " . mysqli_error($conn);
                                    // echo "<script>alert('Password change failed');window.location='./profile.php'</script>";
                                }
                            } else {
                                echo "<script>alert('New password and confirmation password do not match');window.location='./profile.php'</script>";
                            }
                        } else {
                            echo "<script>alert('Current password is incorrect');window.location='./profile.php'</script>";
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </main>
    <!-- JavaScript Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>