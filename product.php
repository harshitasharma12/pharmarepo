<div class="row mt-4 products" id="price_sorted">
  <?php
  if(($filter_show_brand_id)==true){
    $products = product_brand_select_all($filter_show_brand_id, false, true);
  //1. check cutomer login
  //2. get product id from cart of a customer

  while ($product = mysqli_fetch_assoc($products)) {
    $count++;
    if ($is_sidebar) {
      require("product-card.php");
    } else if (!$is_sidebar) {
      if ($count <= 4) {
        require("product-card.php");
      }
    }
  }
  }else{
    $products = product_select_all($filter_cat_id, $filter_sub_id, $filter_detail_id, $filter_brand_id, false, true);
  //1. check cutomer login
  //2. get product id from cart of a customer

  while ($product = mysqli_fetch_assoc($products)) {
    $count++;
    if ($is_sidebar) {
      require("product-card.php");
    } else if (!$is_sidebar) {
      if ($count <= 4) {
        require("product-card.php");
      }
    }
  }
  }

  
  ?>

</div>