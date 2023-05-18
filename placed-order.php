<?php require_once("header.php"); ?>
<?php
$report = [];
$result_set=report_select_by_orderid($_SESSION['order_id']);
while($result=mysqli_fetch_assoc($result_set)){
$report['order_no']=$result['order_no'];
$report['customer_id']=$result['customer_id'];
$report['product_name']=$result['product_name'];
$report['order_date']=$result['order_date'];
if($result['product_type']=='labtest')
{
    $report_data= insert_report($report);
}
}?>

<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-6">
            <div class="card" style="border:0px;">
                <p class="text-center mt-5"><img src="assets/images/placed_order_tickedimg.png" width="50" height="50"></p>
                <div class="card-body" style="box-shadow:30px 20px 110px 100px #024C6805;">

                    <p class="text-center">Your order of &#8377;<?php echo  $_SESSION['total']; ?> is placed</p>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">
                            <a href="my_orders.php" class="btn btn-success btn-block btn-cart px-4">GO TO MY ORDERS</a>
                        </div>
                    </div>
                    </span>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-sm-6">
            <?php $result = cart_total_in_placed_order($_SESSION['order_id']); ?>
            <div class="card mt-4">
                <div class="card-body">
                    <span>Order ID(s):<?php echo $result['order_no']; ?></span>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <span>Order Details</span>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <span>Order Date & Time</span>
                            </div>
                            <div class="row">
                                <span><?php echo $result['order_date']; ?></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="row">
                                <span>Mode of Payment</span>
                            </div>
                            <div class="row">
                                <span><?php echo $result['payment_mode']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php $_SESSION['order_id'] = NULL; ?>
        <?php $_SESSION['total'] = NULL; ?>
    </div>
</div>

<?php require_once("footer.php"); ?>