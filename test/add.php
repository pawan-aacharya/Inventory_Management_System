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
  <script src="../Assets/script.js"></script>
</head>

<body>
  <?php
  include "head.php";
  ?>
  <main class="mt-5 pt-3">
    <div class="container-fluid">
      <div class="row">
        <?php
        if (isset($_POST['submit'])) {
          $category_name = $_POST['category_name'];
          if (isset($_POST['category_status'])) {
            $status = 1;
          } else {
            $status = 0;
          }
          date_default_timezone_set("Asia/Kathmandu");
          $created_date = date("Y-m-d h:i:sa");
          $query = "INSERT INTO `categories_tbl`(`cat_name`, `cat_status`, `created_date`) VALUES ('$category_name','$status','$created_date')";
          $result = mysqli_query($conn, $query);
        }
        ?>
        <h5>Add Category</h5>
        <div class="bg-white border rounded-5 p-2 m-3 form">
          <form action="#" method="post">
            <p class="p-2 mb-2 fw-bold text-center border"><i class="bi bi-plus"></i> Add Category</p>
            <div class="row">
              <div class="col mb-3">
                <div class="">
                  <label class="form-label fw-bold" for="form8Example1">Category Name</label>
                  <input type="text" id="form8Example1" name="category_name" class="form-control" required>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col mb-3">
                <div class="">
                  <label class="form-label fw-bold" for="form8Example2">Category Status</label>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="category_status" value="" id="">
                    <label class="form-check-label" for="Active">
                      Active
                    </label>
                  </div>
                </div>
              </div>
            </div>
            <!-- <div class="row">
          <div class="col-6">
            <div class="form-outline">
              <label class="form-label fw-bold" for="form8Example1">Created Date</label>
              <input type="date" id="form8Example1" class="form-control" />
            </div>
          </div>
        </div> -->
            <!-- <input  type="button" name="submit" id="" class="btn btn-primary" value="Submit"> -->
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>
</html>