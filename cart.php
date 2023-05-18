<?php require_once("header.php"); ?>

<?php
// $row=customer_select_all();
// while($result=mysqli_fetch_assoc($row)){
//     $customer_id=$result['id'];
// }
//$customer_id=get_customer_id();
$_SESSION['order_id']=generate_id();
?>
<?php require_once("header.php") ?>
<section class="">
  <div class="container py-5">

    <div class="row d-flex justify-content-center d-block" id="my_cart">
      <?php

      $result_array = show_details_in_cart($customer_id);

      $items = count($result_array);
      ?>
      <?php $empty_cart="d-none"; if ($items > 0) { ?>
        <?php $discount = 0; ?>
        <?php echo display_errors($errors); ?>
        <?php echo display_session_message(); ?>
        <div class="col-md-8 col-12 col-sm-12">

          <div class="card  cart-card">
            <div class="card-header py-3 " >
              <h5 class="mb-0">Cart - <span id="cart_items"><?php echo $items; ?></span> items</h5>
            </div>
            <?php
            foreach ($result_array as $key => $row) {

              // $total+=$row['price'];

              require("cart_card.php");
            }
            ?>

          </div>

        </div>
        <div class="col-md-4 col-12 col-sm-12 cart-items">
          <div class="card mb-4 cart-card">
            <div class="card-header py-3">
              <h5 class="mb-0">Price Details</h5>
            </div>
            <div class="card-body">
              <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 pb-0">
                  Total Product Price
                  <span id="totalprice">
                    <?php $cart_total = cart_total_by_customer($_SESSION['customer_id']);
                    echo $cart_total; 
                    $_SESSION['total']=$cart_total;?>
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center px-0">
                  Total Discount
                  <span id="discount">
                    <?php $discount = calculate_discount(get_customer_id());
                    echo $discount; ?>
                  </span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center border-0 px-0 mb-3">

                  <strong>Order Total</strong>
                  <span><strong id="net_amount">
                      <?php echo $cart_total - $discount; ?>
                    </strong></span>


                </li>
              </ul>

              <a href="customer-details.php" class="btn btn-success btn-lg btn-block ">
                Go to checkout
              </a>
            </div>
          </div>
        </div>
        </div>
      <?php } else { $empty_cart="d-block"; ?>
        
        
         





      <?php } ?>
    <div class="row <?php echo $empty_cart; ?>" id="empty_cart">
          <div class="d-flex flex-column align-items-center">
            <div class="p-2"><img class="img-fluid" src="assets/images/emptycart.jpg" alt=""></div>
            <div class="p-2"><span><b>Your Medicine/Healthcare cart is Empty!</b></span></div>
            <div class="p-2"><a href="index.php" class="btn btn-success"><b>ADD MEDICINES</b></a></div>
          </div>
        </div>
  </div>
</section>
<?php require_once("footer.php"); ?>