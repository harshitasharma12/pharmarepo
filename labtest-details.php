<?php require_once("header.php") ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $labtest = labtest_select_by_id($id);
    $name = $labtest['name'];
    $also_known = $labtest['also_known'];
    $report = $labtest['report'];
    $price = $labtest['price'];
    $discount=$labtest['discount'];
    $test_include = $labtest['test_include'];
    $test_name = $labtest['test_name'];
    $about = $labtest['about'];
    $gender = $labtest['gender'];
    $age_group = $labtest['age_group'];
    $sample = $labtest['sample'];
}
$labtest = price_after_discountlabtest($id);
$discounted_price = $labtest['discount'];
?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card mt-4" style="box-shadow:3px 2px 5px grey;">
                <div class="card-body">
                    <p style="font-size:21px;font-weight:700"><?php echo $name; ?></p>
                    <?php if ($also_known == true) { ?>
                        <p>
                            <span style="font-size:16px;font-style:italic;font-weight:500">Also Known as </span>
                            <span style="font-size:16px;font-style:italic;font-weight:500"><?php echo $also_known; ?></span>
                        </p>
                    <?php } ?>
                    <hr>
                    <p style="font-size:15px;font-weight:500;">Get reports <span style="font-size:18px;font-weight:700"><?php echo $report; ?></span></p>
                    <hr>
                    <span class="card-text">&#8377;<?php echo  $price - $discounted_price; ?></span>&nbsp;&nbsp;

                    <span class="card-text"><s>&#8377; <?php echo $price; ?></s></span>&nbsp;&nbsp;
                    <span style="color:0e524b;border:1px dotted #0d5d33;"><?php echo $discount; ?>% Off</span>
                </div>
            </div>
                    </div>
            <div class="col-md-6">

                <div class="row">
                    <h5 class="mt-4">Total test include in <?php echo $name; ?> are</h5>
                    <div class="accordion w-100" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <p><?php echo $test_include; ?></p>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse " data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <?php echo $test_name; ?>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mt-4" style="box-shadow:3px 2px 5px grey;">
                            <div class="card-body" style="height:320px;overflow-y:scroll;">
                                <h5>About <?php echo $name; ?></h5>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3 mt-2">
                                                <i class="fas fa-users" style="font-size:23px"></i>
                                            </div>
                                            <div class="col-md-9">
                                                <span>Age group</span><br>
                                                <span><?php echo $age_group; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="row">
                                            <div class="col-md-3 mt-2">
                                                <i class="fas fa-venus-mars" style="font-size:23px"></i>
                                            </div>
                                            <div class="col-md-9">
                                                <span>Gender</span><br>
                                                <span><?php echo $gender; ?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-3 mt-2">
                                                <i class="fas fa-vials" style="font-size:23px"></i>
                                            </div>
                                            <div class="col-md-9">
                                                <span>Sample</span><br>
                                                <span><?php echo $sample; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3" style="text-align:justify"><?php echo $about; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <?php require_once("footer.php"); ?>