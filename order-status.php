<?php if ($order['status'] == 4) { ?>
    <div class="col-md-1 col-2 ">
        <img src="assets/images/return.PNG">
    </div>
<?php } else if ($order['status'] == 3) { ?>
    <div class="col-md-4 col-4">
        <span>CANCELLED</span>
    </div>
<?php } else if ($order['status'] == 5) { ?>
    <div class="col-md-1 col-2">
        <img src="assets/images/delivered.PNG">
    </div>
<?php } else if ($order['status'] == 2) { ?>
    <div class="col-md-4 col-4">
        <span>CONFIRM</span>
    </div>

<?php } else { ?>
    <div class="col-md-4 col-4">
        <span>NEW ORDERS</span>
    </div>
<?php } ?>


<div class="col-md-4 col-4  text-start ">
    <?php if ($order['status'] == 4) { ?>
        <span>RETURN</span>
    <?php } else if ($order['status'] == 5) { ?>
        <span>DELIVERED</span>
    <?php } else {
    } ?>
</div>

<div class="col-md-6 col-6">
    <?php if ($order['status'] == 4) { ?>
        <?php $result=order_by_orderno($order['order_no']);?>
       <span>Reason:<?php echo $result['return_reason'];?></span>
    <?php } ?>
</div>