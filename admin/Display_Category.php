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
    <title>Admin Dashboad</title>
    <!-- ...................CSS Link................... -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">

    <!-- ...................Icons CDN Link................... -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <link rel="stylesheet" href="../Assets/Style1.css">
    <style>
        input:focus {
            box-shadow: none !important;
            border-color: none !important;
        }

        .dataTables_length {
            margin-bottom: 15px;
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
                    <div class="row ">
                        <div class="col-10">
                            <h5 class="fw-bold">View Categories</h5>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-primary mb-2" href="Add_Category.php" role="button"><i class="bi bi-plus"></i>Add Category</a>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM `categories_tbl`";
                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    ?>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <!-- <th scope="col">Category Id</th> -->
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Unit</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Category Status</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $category_id = $row['cat_id'];
                                    $category_name = $row['cat_name'];
                                    $unit = $row['unit'];
                                    $category_status = $row['cat_status'];
                                    $created_date = $row['created_date'];
                                    $status_display = ($category_status == 1) ? 'Active' : 'Inactive';
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo ++$i ?>
                                        </th>
                                        <!-- <td>
                                        <?php echo $category_id ?>
                                    </td> -->
                                        <td>
                                            <?php echo $category_name ?>
                                        </td>
                                        <td>
                                            <?php echo $unit ?>
                                        </td>
                                        <td>
                                            <?php echo $created_date ?>
                                        </td>
                                        <td>
                                            <?php echo $status_display ?>
                                        </td>
                                        <td>
                                            <a href="Edit_category.php?cat_id=<?php echo $category_id ?>"><button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                            <a href="Delete_Category.php?cat_id=<?php echo $category_id ?>"><button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?')"><i class="bi bi-trash-fill"></i></button></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- jquery link -->
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