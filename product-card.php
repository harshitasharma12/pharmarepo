
<div class="col-md-<?php echo $no_of_col; ?> col-sm-6 col-6 mb-4">
<?php $discounted_price=price_after_discountproduct($product['id'])?>
<?php $discount=$discounted_price['discount'];?>
    <div class="card text-center" style="box-shadow:3px 2px 5px grey;">
        <a href="product_details.php?id=<?php echo $product['id']; ?>"> <img src="dashboard/uploads/files/<?php echo $product['filename']; ?>" class="card-img-top mx-auto d-block w-50 mt-3" alt="..." style="height:150px;"></a>
        <div class="card-body" style="height:220px;">
            <p class="fs-6 " style="display:inline-block;min-height: 40px;overflow:hidden;display:-webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;"><?php echo ucwords($product['name']); ?></p>
            <hr>
            <span class="card-text">&#8377;<?php echo $product['price']-$discount;?></span>&nbsp;&nbsp;

            <span class="card-text"><s>&#8377; <?php echo $product['price']; ?></s></span>&nbsp;&nbsp;
            <span style="color:0e524b;border:1px dotted #0d5d33;"><?php echo $product['discount'];?>% Off</span>

            <input type="hidden" class="pid" value="<?php $product['id']; ?>">
            <?php
            if (isset($_SESSION['customer_id'])) {
                if (in_array($product['id'], $arr_cart_product)) { ?>
                 <div class="d-grid gap-2 ">
                    <a href="cart.php" class="btn  btn-block btn-cart btn-added-cart mt-2"  data-id="<?php echo $product['id']; ?>" id="<?php echo "btn-cart-" . $product['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                        Go to Cart</a>
                </div>


                <?php
                } else {

                ?>
                    <?php if ($product['ban'] == get_customer_country()) { ?>
                        <div class="d-grid gap-2 ">
                        <button class="btn btn-block addItemBtn d-none btn-add-cart mt-2" data-id="<?php echo $product['id']; ?>" id="<?php echo "btn-" . $product['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                            Add to Cart</button>
                    </div>
                        <p class="text-center" style="font-size:14px;color:red">*Ban in your country*</p>
                    <?php } else { ?>
                        <div class="d-grid gap-2">
                        <button class="btn btn-block addItemBtn btn-add-cart mt-2 "  data-id="<?php echo $product['id']; ?>" id="<?php echo "btn-" . $product['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                            Add to Cart</button>
                    </div>


                    <?php } ?>

                    <div class="d-grid gap-2 ">
                    <a href="cart.php" class="btn  btn-block btn-cart d-none btn-added-cart mt-2"  data-id="<?php echo $product['id']; ?>" id="<?php echo "btn-cart-" . $product['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                        Go to Cart</a>
                    </div>


                <?php } ?>

            <?php } else { ?>
                <div class="d-grid gap-2 ">
                <a class="btn  btn-block addItemBtn btn-add-cart mt-2"  href="login.php"><i class="fas fa-cart-plus"></i>
                    Add to Cart</a>
            </div>
            <?php } ?>

            <?php if ($product['prescription'] == 'Yes') { ?>
                <p style="font-size:14px;color:red">* This product require Prescription*</p>
            <?php } ?>

        </div>
    </div>
    </div>
    
   
      
