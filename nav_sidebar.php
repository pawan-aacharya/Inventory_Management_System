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
            <li><a class="dropdown-item" href="./LogOut.php">Logout</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<!-- end nav -->
<div class="offcanvas offcanvas-start bg-dark text-white sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
  <!-- <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
      <button type="button" class="btn-close text-reset " data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div> -->
  <div class="offcanvas-body p-0">
    <nav class="navbar-dark">
      <ul class="navbar-nav">
        <li>
          <a href="Dashboard.php" class="nav-link px-3 active mt-4">
            <span class="me-2"><i class="bi bi-speedometer2"></i></span>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="my-4">
          <hr class="dropdown-divider">
        </li>
        <!-- category -->
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseCategory1" role="button" aria-expanded="false" aria-controls="collapseCategory1">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Category</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseCategory1">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_Category.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-kanban"></i></span>
                    <span>Manage Category</span>
                  </a>
                </li>
                <li>
                  <a href="./Add_Category.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-plus"></i></span>
                    <span>Add Category</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>

        <!-- sub categories -->
        <!-- <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseSubCategory" role="button"
            aria-expanded="false" aria-controls="collapseSubCategory">
            <span class="me-2"><i class="bi bi-layout-split"></i></span>
            <span>Sub Category</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseSubCategory">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_Sub_Category.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-kanban"></i></span>
                    <span>Manage Sub_Category</span>
                  </a>
                </li>
                <li>
                  <a href="./Add_Sub_Category.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-plus"></i></span>
                    <span>Add Sub_Category</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li> -->
        <!-- Brand -->
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseBrand" role="button" aria-expanded="false" aria-controls="collapseBrand">
            <span class="me-2"><i class="bi bi-tags"></i></span>
            <span>Brand</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseBrand">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_Brand.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-kanban"></i></span>
                    <span>Manage Brands</span>
                  </a>
                </li>
                <li>
                  <a href="./Add_Brand.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-plus"></i></span>
                    <span>Add Brand</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <!-- supplier -->
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseSuppliers" role="button" aria-expanded="false" aria-controls="collapseSuppliers">
            <span class="me-2"><i class="bi bi-person-fill"></i></span>
            <span>Customer/Suppliers</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseSuppliers">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_Customer_Supplier.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-kanban"></i></span>
                    <span>Manage Suppliers</span>
                  </a>
                </li>
                <li>
                  <a href="./Add_Customer_Supplier.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-plus"></i></span>
                    <span>Add Suppliers</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <!--  Products -->
        <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseProducts" role="button" aria-expanded="false" aria-controls="collapseProducts">
            <span class="me-2"><i class="bi bi-cart4"></i></span>
            <span>Products</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseProducts">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_product.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-kanban"></i></span>
                    <span>Manage Products</span>
                  </a>
                </li>
                <li>
                  <a href="./Add_Product.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-plus"></i></span>
                    <span>Add Product</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        </li>
        <!-- purchase  -->
        <li>
          <a class="nav-link px-3 sidebar-link" href="./Purchase_Product.php">
            <span class="me-2"><i class="bi bi-bag-plus"></i></span>
            <span>Purchase Product</span>
          </a>
        </li>
        <!-- sales  -->
        <li>
          <a class="nav-link px-3 sidebar-link" href="./Sales_Product.php">
            <span class="me-2"><i class="bi bi-cart-x"></i></span>
            <span>Sales Product</span>
          </a>
        </li>
        <!-- inventory -->
        <li>
          <a class="nav-link px-3 sidebar-link" href="./Manage_Inventory.php">
            <span class="me-2"><i class="bi bi-shop-window"></i></span>
            <span>Inventory</span>
          </a>
        </li>


        <!-- search product -->
        <!-- <li>
          <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseReports" role="button" aria-expanded="false" aria-controls="collapseReports">
            <span class="me-2"><i class="bi bi-newspaper"></i></span>
            <span>Reports</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseReports">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Search_purchase.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-shop-window"></i></span>
                    <span>Purchase Report</span>
                  </a>
                </li>
                <li>
                  <a href="./Search_Sales.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-receipt"></i></span>
                    <span>Sales Report</span>
                  </a>
                </li>
              </ul>
            </div>
          </div> -->

        <li>
          <a href="./purchase_sales_report.php" class="nav-link px-3">
            <span class="me-2"><i class="bi bi-receipt"></i></span>
            <span>Purchase Sales Report</span>
          </a>
        </li>
        <!-- purchase sales log -->
        <li>
          <a class="nav-link px-3 sidebar-link" href="./Display_Purchase_Sales.php">
            <span class="me-2"><i class="bi bi-card-list"></i></span>
            <span>Purchase Sales Log</span>
          </a>
        </li>

        <!-- message -->
        <a class="nav-link px-3 sidebar-link" data-bs-toggle="collapse" href="#collapseMessage" role="button" aria-expanded="false" aria-controls="collapseMessage">
            <span class="me-2"><i class="bi bi-chat-dots"></i></span>
            <span>Message</span>
            <span class="right-icon ms-auto">
              <i class="bi bi-chevron-down"></i>
            </span>
          </a>
          <div class="collapse" id="collapseMessage">
            <div>
              <ul class="navbar-nav ps-3">
                <li>
                  <a href="./Display_Message.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-envelope-exclamation-fill"></i></span>
                    <span>New Message</span>
                  </a>
                </li>
                <li>
                  <a href="./Read_Message.php" class="nav-link px-3">
                    <span class="me-2"><i class="bi bi-envelope-check-fill"></i></span>
                    <span>Readed Message</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
      </ul>
    </nav>
  </div>
</div>

<!-- <script>
  const collapseElements = document.querySelectorAll('[data-bs-toggle="collapse"]');
collapseElements.forEach(function (element) {
  element.addEventListener('click', function () {
    const targetCollapse = document.querySelector(element.getAttribute('href'));
    collapseElements.forEach(function (el) {
      if (el !== element && el.getAttribute('href') !== element.getAttribute('href')) {
        const otherCollapse = document.querySelector(el.getAttribute('href'));
        if (otherCollapse.classList.contains('show')) {
          el.click();
        }
      }
    });
  });
});

</script> -->

<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {
    $('.sidebar-link').click(function () {
      // Check if the clicked link's sidebar is already expanded
      var isExpanded = $(this).attr('aria-expanded') === 'true';

      // Collapse all other expanded sidebars
      $('.sidebar-link').attr('aria-expanded', 'false');
      $('.sidebar-link').removeClass('collapsed');
      $('.collapse').removeClass('show');

      // Expand or collapse the clicked link's sidebar accordingly
      $(this).attr('aria-expanded', !isExpanded);
      $(this).toggleClass('collapsed');
      $(this).next('.collapse').toggleClass('show');
    });
  });
</script> -->