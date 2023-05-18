<?php require_once("header.php"); ?>
<section id="slider" class="mt-2">
  <div class="container">
    <?php if ((isset($_POST['apply_filter'])) || (isset($_GET['cat_id'])) || (isset($_GET['sub_id'])) || (isset($_GET['detail_id']))) { ?>
      <div class="row">
        <div class="col-md-12">
          <img src="assets/images/slider5.jpg" height="450" class="d-block w-100" alt="...">
        </div>
      </div>
    <?php } elseif ((isset($_GET['brand_id'])) || (isset($_POST['apply_brand']))) { ?>
      <div class="row">
        <div class="col-md-12">
          <img src="assets/images/slider4.jpg" height="450" class="d-block w-100" alt="...">
        </div>
      </div>
    <?php } else { ?>
      <div class="row">
        <div class="col-md-9 col-12 col-sm-12">
          <!-- slider goes here -->
          <?php require_once("slider.php"); ?>
        </div>
        <div class="col-md-3">
          <div class="row mt-3">
            <div class="col-md-12 col-12 col-sm-12">
              <div class="card text-center  border-0" style="background-color:#F6FFFA;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                  <h5 class="card-title" style="font-size:17px;">NEED ANY HELP REGARDING HEALTH?</h5>
                  <p class="card-text" style="font-size:14px;">Consult Online Doctor<br>Speak To A Doctor From Your Home</p>
                  <a href="consult.php" class="btn btn-success">Schedule Now</a>
                </div>
              </div>
            </div>
          </div>

          <!-- 2 row -->
          <div class="row mt-3">
            <div class="col-md-12  col-sm-12 col-12">
              <div class="card text-center border-0" style="background-color:#F6FFFA;">
                <!-- <img src="..." class="card-img-top" alt="..."> -->
                <div class="card-body">
                  <h5 class="card-title" style="font-size:17px;">GET AMAZING REWARDS</h5>
                  <p class="card-text" style="font-size:14px;">Get Upto 10 - 50 % OFF on products on Our Website</p>
                  <a href="#" class="btn btn-success">Order Now</a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    <?php } ?>
  </div>
</section>

<section id="card" class="mt-2">
  <?php if (isset($_POST['apply_filter'])) {
    $filter_sub_id = $_POST['sub_id'];
    $filter_cat_id = category_by_sub_cat($filter_sub_id);
    $filter_detail_id = detail_id_by_sub_id($filter_sub_id);
    // $filter_brand_id=$_POST['brand_id'];
    $filter_brand_id = get_brand_id_by_detail_id($filter_detail_id);
    $no_of_col = 4;
    include("show_categories.php");
  } else if (isset($_POST['apply_brand'])) {
    $filter_brand_id = $_POST['brand_id'];
    $no_of_col = 4;
    include("show_categories.php");
  } else if (isset($_POST['apply_filter_brand'])) {
    $filter_show_brand_id = $_POST['show_brand_id'];
    $no_of_col = 4;
    include("brand_view_all.php");
  } else if ((isset($_GET['brand_id'])) || (isset($_GET['cat_id'])) || (isset($_GET['sub_id'])) || (isset($_GET['detail_id']))) {  ?>
    <?php include("show_categories.php"); ?>
  <?php } else { ?>
    <div class="container">
      <?php
      $no_of_col = 3;
      $categories = find_all_category();
      $rows = 1;
      $banner_counter = 1;
      while ($category = mysqli_fetch_assoc($categories)) {
        $filter_cat_id = explode(",", $category['id']);
        $count = 0;

      ?>
        <div class="row">
          <div class="col-md-12 d-flex justify-content-between">
            <div class="indexpage_heading"><?php echo $category['name']; ?></div>
            <div><a href="index.php?cat_id=<?php echo $category['id']; ?>" class="indexpage_heading">View All</a></div>
          </div>
          <div class="col-12 mx-auto">
            <hr class="border border-dark border-1 opacity-100" style="width:100%;">
          </div>
        </div>
        <?php $is_sidebar = false; ?>
        <?php

        ?>
        <?php include("product.php"); ?>
        <?php if ($rows % 3 == 0 && $banner_counter <= 3) { ?>
          <?php $banner_counter++; ?>
          <?php include("banner.php"); ?>
        <?php } ?>
        <?php $rows++;  ?>
    <?php }
    } ?>
    </div>

</section>

<section>
  <?php if ((isset($_POST['apply_filter_brand'])) || (isset($_GET['brand_id'])) || (isset($_GET['cat_id'])) || (isset($_GET['sub_id'])) || (isset($_GET['detail_id']))) {
  } else { ?>
    <div class="container">
      <div class="row mt-4">
        <div class="col-md-12 d-flex justify-content-between">
          <div class="indexpage_heading">Brands</div>
          <div><a href="brand_view_all.php" class="indexpage_heading">View All</a></div>
        </div>
        <div class="col-12 mx-auto">
          <hr class="border border-dark border-1 opacity-100" style="width:100%;">
        </div>
      </div>
      <div class="row">
        <?php $count = 0; ?>
        <?php $no_of_col = 3; ?>
        <?php $brands = brand_select_all(); ?>
      <?php while ($brand = mysqli_fetch_assoc($brands)) {
        $show_brand_id = explode(",", $brand['id']);
        if ($count <= 5) {
          require("brand-index.php");
        }
        $count++;
      }
    }
      ?>
      </div>
    </div>
</section>
<?php require_once("footer.php"); ?>