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
    <title>Admin Dashboard</title>
    <!-- CSS Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- ...................JavaScript Link................... -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Icons CDN Link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../Assets/Style1.css">
    <link rel="stylesheet" href="../Assets/DataTables/datatables.min.css">
    <style>
        input:focus,
        select:focus {
            box-shadow: none !important;
            border-color: none !important;
        }

        .dataTables_length {
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <?php include "../nav_sidebar.php"; ?>

    <main class="mt-5 pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <h5 class="fw-bold">Sales Detail</h5>
                    <hr>
                    <div class="bg-white border rounded-5 p-2 m-3">
                        <table class="table table-striped" id="myTable">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Customer Name</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Rate</th>
                                    <th scope="col">DAte</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 1;
                                

                                ?>
                                <tr>
                                    <th scope="row">
                                        <?php echo $count++; ?>
                                    </th>
                                    <td>
                                        <?php  ?>
                                    </td>
                                    <td>
                                        <?php  ?>
                                    </td>
                                    <td>
                                        <?php ?>
                                    </td>
                                    <td>
                                        <?php ?>
                                    </td>
                                    <td>
                                        <?php ?>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col text-end">
                                <button type="button" class="btn btn-primary">Print</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- jquery link -->
    <script src="../Assets/jquery.min.js"></script>
    <script src="../Assets/DataTables/datatables.min.js"></script>
    <script>
        $('#myTable').DataTable({
            "ordering": false,
            "lengthMenu": [
                [3, 10, 25, 50, 100, -1],
                [3, 10, 25, 50, 100, "All"]
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