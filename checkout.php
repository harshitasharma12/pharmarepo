<?php require("header.php"); ?>
<?php
$contact = get_customer_contact();

?>
<div class="container">

    <form method="post" action="checkout-exec.php">

        <div class="row mt-5">

            <div class="col-md-5 col-12 mx-auto">
                <div class="card" style="box-shadow:3px 2px 10px grey;">
                    <div class="card-body">
                        <h4 class="mb-3">Payment Mode</h4>
                        <div class="my-3">
                            <div class="form-check">
                                <input id="cashondelivery" value="COD" name="payment" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="cashDelivery">Cash on Delivery</label>
                            </div>
                            <div class="form-check">
                                <input id="online" value="Online" name="payment" type="radio" class="form-check-input" required>
                                <label class="form-check-label" for="online">Online</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mt-3 d-none" id="cash">
            <div class="col-md-5 col-12 mx-auto">
                <div class="card" style="box-shadow:3px 2px 10px grey;">
                    <div class="card-body">
                        <div class="form-floating mb-3">
                            <input type="number" name="contact" class="form-control" id="floatingInput" placeholder="name@example.com">
                            <label for="floatingInput">Contact Number</label>
                        </div>
                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-success" name="submit"><strong>Confirm</strong></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>


    <div class="row mt-3 d-none" id="onlinepay">
        <div class="col-md-8 col-12 mx-auto">
            <div class="card" style="box-shadow:3px 2px 10px grey;">
                <div class="card-body">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    WALLETS
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <!-- <div class="accordion-body" style="border-bottom:1px solid grey">
                                    <div class="row">
                                        <div class="col-md-3 col-4">
                                            <img src="assets/images/phonepe.png" width="100" height="50">
                                        </div>
                                        <div class="col-md-3 mt-3 col-4">
                                            PhonePe
                                        </div>
                                        <div class="col-md-6 col-4 mt-3 text-end">
                                            <a href="">PAY NOW</a>
                                        </div>

                                    </div>
                                </div> -->

                                <div class="accordion-body" style="border-bottom:1px solid grey">
                                    <div class="row">
                                        <div class="col-md-3 col-4">
                                            <img src="assets/images/paytm.png" width="100" height="50">
                                        </div>
                                        <div class="col-md-3 col-4 mt-2">
                                            Paytm
                                        </div>
                                        <div class="col-md-6 col-4 text-end mt-2">
                                            <a href="onlinepayment.php">PAY NOW</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>

<?php require("footer.php"); ?>