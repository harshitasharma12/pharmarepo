<?php require_once("dashboard/includes/initialize.php"); ?>
<?php
$filter_brand_id = [];
$filter_show_brand_id = [];
$filter_cat_id = [];
$filter_sub_id = [];
$filter_detail_id = [];
$count = 0;
$no_of_col = 3;
if (isset($_GET['brand_id'])) {
  $filter_brand_id = explode(",", $_GET['brand_id']);
  $no_of_col = 4;
}
if (isset($_GET['show_brand_id'])) {
  $filter_show_brand_id = explode(",", $_GET['show_brand_id']);
  $no_of_col = 4;
}
if (isset($_GET['cat_id'])) {
  $filter_cat_id = explode(",", $_GET['cat_id']);
  $no_of_col = 4;
}
if (isset($_GET['sub_id'])) {
  $filter_sub_id = explode(",", $_GET['sub_id']);
  $filter_cat_id = category_by_sub_cat($filter_sub_id);
  $filter_detail_id = detail_id_by_sub_id($filter_sub_id);
  $no_of_col = 4;
}
if (isset($_GET['detail_id'])) {
  $filter_detail_id = explode(",", $_GET['detail_id']);
  $filter_sub_id = sub_category_by_detail_id($filter_detail_id);
  $filter_cat_id = category_by_sub_cat($filter_sub_id);
  $filter_brand_id = get_brand_id_by_detail_id($filter_detail_id);
  $no_of_col = 4;
}
?>

<?php
$arr_cart_product  = array();
$items = 0;
if (isset($_SESSION['customer_id'])) {
  $customer_id = get_customer_id();
  $cart_products = show_details_in_cart($_SESSION['customer_id']);
  foreach ($cart_products as $key => $cart_product) {

    $arr_cart_product[] = $cart_product['product_id'];
  }
  $items = count($arr_cart_product);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/custom.css?ver=<?php echo rand(); ?>">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
  <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
 
  <title>TRUST CARE</title>

</head>


<body style="font-family: 'Lato', sans-serif;">
  <div id="main">
  <div id="searchresult"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <?php require_once("navbar-top.php"); ?>
        </div>
      </div>
    </div>
    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <?php require_once("dynamic-navbar.php"); ?>
          </div>
        </div>
      </div>
    </section>