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
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css"> -->

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
    <script src="../Assets/script.js"></script>
    <style>
        .dataTables_length {
            margin-bottom: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>

<body>
    <?php
    include "../nav_sidebar.php";
    ?>
    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="row">
                        <div class="col-10">
                            <h5 class="fw-bold">New Messages</h5>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM `message` WHERE `status`='0' ORDER BY `date` ASC";
                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    ?>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped m-2 " id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Email Address</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Message</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $id = $row['id'];
                                    $date = $row['date'];
                                    $email = $row['email'];
                                    $contact = $row['contact'];
                                    $message = $row['message'];
                                    $status = $row['status'];
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo ++$i ?>
                                        </th>
                                        <td>
                                            <?php echo $date ?>
                                        </td>
                                        <td>
                                            <?php echo $email ?>
                                        </td>
                                        <td>
                                            <?php echo $contact ?>
                                        </td>
                                        <td>
                                            <?php echo $message ?>
                                        </td>
                                        <td>
                                            <a href="https://mail.google.com/mail/?view=cm&fs=1&to=<?php echo $email; ?>" target="_blank" class="m-1"><button class="btn btn-primary"><i class="bi bi-send-arrow-up-fill"></i>&nbsp;Reply</button></a>
                                            <a href="Delete_Message.php?id=<?php echo $id ?> & status=<?=$status ?>" class="m-1"><button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?');"><i class="bi bi-trash-fill"></i></button></a>
                                            <?php if ($status == 0) { ?> <a href="Update_Message.php?id=<?= $id ?>" class="m-1"><button class="btn btn-warning">Read</button></a><?php } ?>
                                        </td>
                                    </tr>
                            </tbody>
                        <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script src="../Assets/jquery.min.js"></script>
    <script src="../Assets/DataTables/datatables.min.js"></script>
    <script>
        $('#myTable').DataTable({
            "ordering": false,
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            // "scrollX":true;
            language: {
                search: "_INPUT_",
                searchplaceholder: "search...."
            }
        });
    </script>
</body>

</html>