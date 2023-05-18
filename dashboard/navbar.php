<?php require_login(); ?>
<nav class="sb-sidenav accordion sb-sidenav-dark d-print-none" id="sidenavAccordion">
  <div class="sb-sidenav-menu">
    <div class="nav">

      <a class="nav-link" href="index.php">
        <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
        Home
      </a>
      <?php if (is_admin()) { ?>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#categories" aria-expanded="false" aria-controls="categories">
          <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
          Product Categories
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="categories" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="category-list.php">Category List</a>
            <a class="nav-link" href="sub-category-list.php">Sub Category List</a>
            <a class="nav-link" href="sub-sub-category-list.php">Detail List</a>


          </nav>
        </div>

        <a class="nav-link" href="product-list.php">
          <div class="sb-nav-link-icon"><i class="fab fa-product-hunt "></i></div>
          Product
        </a>

        

        <a class="nav-link" href="brand-list.php">
          <div class="sb-nav-link-icon"><i class="fab fa-bimobject"></i></div>
          Brand
        </a>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#location" aria-expanded="false" aria-controls="location">
          <div class="sb-nav-link-icon"><i class="fas fa-map-marker-alt"></i></div>
          Location
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="location" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="country-list.php">Country List</a>
            <a class="nav-link" href="state-list.php">State List</a>
            <a class="nav-link" href="city-list.php">City List</a>


          </nav>
        </div>

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#doctor_data" aria-expanded="false" aria-controls="doctor_data">
          <div class="sb-nav-link-icon"><i class="fas fa-user-md"></i></div>
          Doctor Data
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="doctor_data" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="doctor-list.php">Doctor</a>
            <a class="nav-link" href="appoinment-list.php">Appoinment</a>
            <a class="nav-link" href="speciality-list.php">Speciality</a>


          </nav>
        </div>

        <a class="nav-link" href="labtest-list.php">
          <div class="sb-nav-link-icon"><i class="fas fa-vials"></i></div>
          labtest
        </a>

        <a class="nav-link" href="report-list.php">
          <div class="sb-nav-link-icon"><i class="fas fa-file-alt"></i></div>
          Report
        </a>

        <!-- <a class="nav-link" href="product-list.php">
          <div class="sb-nav-link-icon"><i class="fab fa-product-hunt "></i></div>
          Product
        </a> -->

        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#order_status" aria-expanded="false" aria-controls="order_status">
          <div class="sb-nav-link-icon"><i class="fas fa-box-open"></i></div>
          Orders
          <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="order_status" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
          <nav class="sb-sidenav-menu-nested nav">
            <a class="nav-link" href="order-list.php?id=1">New Orders</a>
            <a class="nav-link" href="order-list.php?id=2">Confirm Orders</a>
            <a class="nav-link" href="order-list.php?id=3">Cancel Orders</a>
            <a class="nav-link" href="order-list.php?id=4">Return Orders</a>
            <a class="nav-link" href="order-list.php?id=5">Delivered Orders</a>


          </nav>
        </div>
      <?php } ?>

      <?php if (is_doctor()) { ?>
        <a class="nav-link" href="appoinment-list.php">
          <div class="sb-nav-link-icon"><i class="fab fa-bimobject"></i></div>
          Appointment
        </a>

        <a class="nav-link" href="timeslot-list.php">
          <div class="sb-nav-link-icon"><i class="fab fa-bimobject"></i></div>
          Time Slot
        </a>
      <?php } ?>



      <a class="nav-link" href="change-password.php">
        <div class="sb-nav-link-icon"><i class="fas fa-key"></i></div>
        Change Password
      </a>
      <a class="nav-link" href="logout.php">
        <div class="sb-nav-link-icon"><i class="fas fa-sign-out-alt"></i></div>
        Logout
      </a>
    </div>
  </div>
  <div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <?php echo ($_SESSION['username']);  ?>
    <?php if (is_admin()) { ?>
      <?php echo ($_SESSION['username']);  ?>
    <?php } else if (is_doctor()) { ?>
      <?php echo ($_SESSION['username']);  ?>
    <?php } ?>
  </div>
</nav>