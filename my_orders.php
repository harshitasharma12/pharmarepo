<?php require_once("header.php"); ?>
<?php $customer = get_customer_id(); ?>
<div class="container">

    <div class="row">
        <div class="col-md-11 mx-auto">
            <div class="row">
                <div class="col-md-4 col-12 col-sm-12 mt-5">
                    <div class="card ">
                        <div class="card-body">
                            <p class="fs-6">ADITIONAL DETAILS</p>
                            <hr>
                            <span style="font-size:13px;">Username: <?php echo get_customer_email(); ?></span><br>
                            <span style="font-size:13px;">Contact: <?php echo get_customer_contact(); ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-12 col-sm-12">
                    <div class="row mt-2">
                        <span>All Orders From Anytime</span>
                    </div>
                    <div class="row mb-4 mt-3" style="height:500px;overflow-y:scroll;">
                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="card " style="background-color:#f5f5f5;">
                                <div class="card-body">

                                    <?php $orders = my_order($customer_id);
                                    while ($order = mysqli_fetch_assoc($orders)) { ?>
                                        <div class="card mt-2">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6">
                                                        <p class="fs-6 px-2">Order No: <?php echo $order['order_no']; ?></p>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6">
                                                        <p class="fs-6 px-2">Order Date: <?php echo datetime_to_text($order['order_date']); ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <?php require("order-status.php"); ?>

                                                </div>
                                          
                                            <div class="row mt-1">
                                                <div class="col-md-11 col-12 col-sm-12 mx-auto">
                                                    <div class="row">
                                                        <?php require("order-items.php"); ?>


                                                        <div class="col-md-10 px-4">
                                                            <div class="row">
                                                                <?php

                                                                ?>
                                                            </div>
                                                            <div class="row">
                                                                <?php if (can_cancel_order($order['id'])) { ?>
                                                                    <?php if ($order['status'] == "1" && $order['status'] != "3") {  ?>
                                                                        <p>
                                                                        <form action="status_update.php" method="GET">
                                                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                                            <input type="hidden" name="cancel_id" value="3">
                                                                            <input type="hidden" name="order_no" value="<?php echo $order['order_no']; ?>">
                                                                            <button name="btnCancel" class="btn btn-danger">Cancel</button>
                                                                        </form>
                                                                        </p>
                                                                    <?php } ?>
                                                                <?php }?>
                                                                
                                                                <?php if (can_return_order($order['id'])) { ?>
                                                               <?php if ($order['status'] === "5") { ?>    
                                                                        <form action="status_update.php" method="GET">
                                                                            <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                                                                            <input type="hidden" name="cancel_id" value="4">
                                                                            <input type="hidden" name="order_no" value="<?php echo $order['order_no']; ?>">
                                                                            <button type="button" name="btnReturn" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                                Return
                                                                            </button>
                                                                            <!-- Modal -->
                                                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Reason for Return</h1>
                                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <form action="" method="GET" enctype="multipart/form-data">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="return_reason" id="flexRadioDefault1" value="The product arrived too late">
                                                                                                    <label class="form-check-label" for="flexRadioDefault1">
                                                                                                        The product arrived too late
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="return_reason" id="flexRadioDefault2" value="The product was damaged ">
                                                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                                                        The product was damaged
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="return_reason" id="flexRadioDefault2" value=" The merchant shipped the wrong product">
                                                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                                                        The merchant shipped the wrong product
                                                                                                    </label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="return_reason" id="flexRadioDefault2" value="The product did not match the description">
                                                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                                                        The product did not match the description
                                                                                                    </label>
                                                                                                </div>

                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="return_reason" id="flexRadioDefault2" value="Product(s) delivered are past or near to its expiry date">
                                                                                                    <label class="form-check-label" for="flexRadioDefault2">
                                                                                                    Product(s) delivered are past or near to its expiry date 
                                                                                                    </label>
                                                                                                </div>

                                                                                                <div class="modal-footer">
                                                                                                    <button name="submit" class="btn btn-outline-success">Submit</button>
                                                                                                </div>
                                                                                            </form>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                       
                                                                        </form>
                                                                        <?php }?>
                                                                        <?php } ?>
                                                                  
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                </div>
                            <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




</div>



<?php require_once("footer.php"); ?>