<?php $labtest = price_after_discountlabtest($result['id']) ?>
<?php $discount=$labtest['discount'];?>
<div class="col-md-3 col-6 mb-4">
    <div class="card text-center" style="box-shadow:3px 2px 5px grey;">
        <a href="labtest-details.php?id=<?php echo $result['id']; ?>" style="color:black;text-decoration:none;"> <img src="dashboard/uploads/labtest/<?php echo $result['filename']; ?>" class="card-img-top mx-auto d-block w-25 mt-3" alt="..." style="height:50px;">
            <div class="card-body" style="height:220px;">
                <span class="fs-6 " style="font-size:14px; display:inline-block;min-height: 30px;overflow:hidden;display:-webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;"><?php echo ucwords($result['name']); ?></span>
                <span class="card-text " style="text-align:center;">Report: <?php echo $result['report']; ?></span><br>
                <span class="card-text " style="text-align:center;"><?php echo $result['test_include']; ?></span><br>

                <hr>
                <span class="card-text">&#8377;<?php echo  $result['price']- $discount; ?></span>&nbsp;&nbsp;

                <span class="card-text"><s>&#8377; <?php echo $result['price']; ?></s></span>&nbsp;&nbsp;
                <span style="color:0e524b;border:1px dotted #0d5d33;"><?php echo $result['discount']; ?>% Off</span>
        </a>
        <input type="hidden" class="lid" value="<?php $result['id']; ?>">

        <?php
        if (isset($_SESSION['customer_id'])) {
            if (in_array($result['id'], $arr_cart_product)) { ?>
                <a href="cart.php" class="btn  btn-block btn-cart btn-added-cart mt-2" data-id="<?php echo $result['id']; ?>" id="<?php echo "btn-cart-" . $result['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                    Added to Cart</a>
            <?php
            } else {

            ?>

                <button class="btn btn-block addlabtestBtn btn-add-cart mt-2" data-id="<?php echo $result['id']; ?>" id="<?php echo "btn-" . $result['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                    Add to Cart</button>
                <a href="cart.php" class="btn btn-block btn-cart d-none btn-added-cart mt-2" data-id="<?php echo $result['id']; ?>" id="<?php echo "btn-cart-" . $result['id']; ?>" data-customer="<?php echo $_SESSION['customer_id']; ?>"><i class="fas fa-cart-plus"></i>
                    Added to Cart</a>


            <?php } ?>

        <?php } else { ?>
            <a class="btn  btn-block btn-add-cart addlabtestBtn mt-2 " href="login.php"><i class="fas fa-cart-plus"></i>
                Add to Cart</a>
        <?php } ?>


    </div>

</div>
</div>