<?php require_once("dashboard/includes/initialize.php"); ?>
<?php require_once("header.php") ?>
<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = product_select_by_id($id);
    $name = $product['name'];
    $image = $product['filename'];
    $price = $product['price'];
    $discount=$product['discount'];
    $description = $product['description'];
    $uses_of = $product['uses_of'];
    $key_benefits = $product['key_benefits'];
    $directions = $product['directions'];
    $safety_information = $product['safety_information'];
    $key_ingredient = $product['key_ingredient'];
    $expiry = $product['expire_date'];
    $warranty = $product['warranty'];
    // $return_item = $product['return_item'];
}
?>
<?php $result=price_after_discountproduct($id)?>
<?php $discounted_price=$result['discount'];?>
<!-- content -->
<section class="py-5">
    <div class="container">
        <div class="row gx-5">


            <aside class="col-lg-4">
                <div class="border rounded-4 mb-3 d-flex justify-content-center" style="box-shadow:3px 2px 5px grey;">
                    <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image" href="https://bootstrap-ecommerce.com/bootstrap5-ecommerce/images/items/detail1/big.webp">
                        <img style="max-width: 100%; max-height: 70vh; margin: auto;" class="rounded-4 fit" src="dashboard/uploads/files/<?php echo $image; ?>" />
                    </a>
                </div>

            </aside>

            <main class="col-lg-5">
                <div class="ps-lg-3">
                    <h4 class="title text-dark">
                        <?php echo $name; ?>
                    </h4>

                    <span class="fs-5">Product Details</span><br>
                    <hr>
                    <?php if ($description == true) { ?>
                        <p>
                            <span class="fs-5">Description</span><br>
                            <?php echo $description; ?>
                        </p>
                    <?php } ?>

                </div>
            </main>

            <div class="col-lg-3">
                <div class="card text-center" style=" box-shadow:3px 2px 5px grey;">
                    <div class="card-body">
                        <div class="mb-3">
                            <span class="card-text fs-5">&#8377;<?php echo  $price - $discounted_price; ?></span>&nbsp;&nbsp;

                            <span class="card-text fs-5"><s>&#8377; <?php echo $price; ?></s></span>&nbsp;&nbsp;
                            <span class="fs-5" style="color:0e524b;border:1px dotted #0d5d33;"><?php echo $discount; ?>% Off</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <?php if ($uses_of == true) { ?>
                    <p>
                        <span class="fs-5">Uses of <?php echo $product['name']; ?></span><br>
                        <?php echo $uses_of; ?>
                    </p>
                <?php } ?>

                <?php if ($key_benefits == true) { ?>
                    <p>
                        <span class="fs-5">Key_Benefits</span><br>
                        <?php echo $key_benefits; ?>
                    </p>
                <?php } ?>

                <?php if ($directions == true) { ?>
                    <p>
                        <span class="fs-5">Directions</span><br>
                        <?php echo $directions; ?>
                    </p>
                <?php } ?>

                <?php if ($safety_information == true) { ?>
                    <p>
                        <span class="fs-5">Safety_information</span><br>
                        <?php echo $safety_information; ?>
                    </p>
                <?php } ?>

                <?php if ($key_ingredient == true) { ?>
                    <p>
                        <span class="fs-5">Key Ingredient</span><br>
                        <?php echo $key_ingredient; ?>
                    </p>
                <?php } ?>
                <hr>
                <h6>Other Information</h6>
                <div class="col-2">
                    <hr>
                </div>

              
                <?php if ($expiry != '0') { ?>
                    <p>
                        <span class="fs-6">Expires after-</span>
                        <?php echo $expiry; ?>
                    </p>
                <?php } ?>
                <?php if ($warranty !='0') { ?>
                    <p>
                        <span class="fs-6">Warranty Upto </span>
                        <?php echo $warranty; ?>
                        <span>Years</span>
                    </p>
                <?php } ?>



            </div>
        </div>
    </div>
</section>

<!-- content -->