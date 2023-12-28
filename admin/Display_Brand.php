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
                            <h5 class="fw-bold">View Brands</h5>
                        </div>
                        <div class="col-2">
                            <a class="btn btn-primary mb-2" href="Add_Brand.php" role="button"><i class="bi bi-plus"></i>Add Brand</a>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $query = "SELECT * FROM brand_tbl INNER JOIN categories_tbl ON categories_tbl.cat_id=brand_tbl.cat_id;";
                    $result = mysqli_query($conn, $query);
                    $i = 0;
                    ?>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table m-2" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">S.N</th>
                                    <th scope="col">Brand Name</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $brand_id = $row['b_id'];
                                    $brand_name = $row['b_name'];
                                    $category_name=$row['cat_name'];
                                    $brand_status = $row['b_status'];
                                    $created_date = $row['created_date'];
                                    $status_display = ($brand_status == 1) ? 'Active' : 'Inactive';
                                ?>
                                    <tr>
                                        <th scope="row">
                                            <?php echo ++$i ?>
                                        </th>
                                        <td>
                                            <?php echo $brand_name ?>
                                        </td>
                                        <td>
                                            <?php echo $category_name ?>
                                        </td>
                                        <td>
                                            <?php echo $status_display ?>
                                        </td>
                                        <td>
                                            <?php echo $created_date ?>
                                        </td>
                                        <td>
                                            <a href="Edit_Brand.php?b_id=<?php echo $brand_id ?>"><button class="btn btn-primary"><i class="bi bi-pencil-square"></i></button></a>
                                            <a href="Delete_Brand.php?b_id=<?php echo $brand_id ?>"><button class="btn btn-danger" onclick="return confirm('Are you sure want to delete?');"><i class="bi bi-trash-fill"></i></button></a>

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