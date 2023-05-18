<?php require_once("header.php"); ?>
<div class="container">
    <div class="row d-flex justify-content-center mt-4">
        <div class="col-md-5 col-12">
            <div class="card" style="box-shadow:3px 2px 5px grey;">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-2 col-2 col-2">
                           <i class="fa-solid fa-arrow-left"></i>
                        </div>
                        <div class="col-md-8 col-8">
                            <img src="assets/images/paytm.png" class="card-img-top mx-auto d-block w-50" alt="..." style="height:40px;">
                        </div>
                    </div>
                    <div class="row mt-2">
                        <span class="fs-6">TRUST CARE PHARMACY</span>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-11 col-11 mx-auto">
                        <div class="row">
                        <div class="col-md-6 col-6">
                            <span>Selected Option to pay</span>
                        </div>
                        <div class="col-md-6 col-6 text-end">
                            <span>&#8377;<?php echo  $_SESSION['total']; ?></span>
                        </div>
                    </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                       <div class="col-md-11 mx-auto">
                        <div class="card" style="box-shadow:3px 2px 5px grey;">
                            <div class="card-body">
                                <div class="row">
                                <div class="col-md-6 col-4">
                                        Scan QR with Paytm to Pay
                                    </div>
                                    <div class="col-md-6 col-8" style="box-shadow:30px 20px 110px 20px #024C6805;">
                                    <img src="assets/images/paytmscan.png" class="card-img-top mx-auto d-block w-100" alt="..." style="height:150px;">
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
</div>



<?php require_once("footer.php"); ?>