<?php require_once("dashboard/includes/initialize.php"); ?>
<?php
if (isset($_SESSION['customer_id'])) {
    $result = customer_select_by_id($_SESSION['customer_id']);
    $id = $result['id'];
    $fname = $result['first_name'];
    $lname = $result['last_name'];
    $email = $result['email'];
    $contact = $result['contact'];
}
?>
<?php require_once("header.php"); ?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-6 col-sm-12 col-12">
            <div class="card mb-4 mt-5 "style="box-shadow:3px 2px 10px grey;">
                <div class="card py-3" style="border:0 ">
                    <h5 class="mb-0 px-3">Customer Details</h5>
                    <hr>
                </div>
                <div class="card-body">
                    <form class="mx-auto">
                        <!-- 2 column grid layout with text inputs for the first and last names -->
                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="firstname" value="<?php echo $fname; ?>" readonly placeholder="First name">

                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="lastname" value="<?php echo $lname; ?>" readonly placeholder="Last Name">

                                </div>
                            </div>
                        </div>

                        <!-- Email input -->
                        <div class="row mb-4">
                            <div class="col-md-7 col-7 col-sm-7">
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" value="<?php echo $email; ?>" id="email" readonly placeholder="email">

                                </div>
                            </div>
                            <div class="col-md-5 col-5">
                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" value="<?php echo $contact; ?>" id="contact" readonly placeholder="contact">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                Select Delivery Address
                            </div>
                            <div class="col-md-6 mb-3 text-end add_address">
                                <a class="new_address" href="address_details.php"> +ADD NEW ADDRESS</a>
                            </div>
                        </div>

                        <?php
                        $result = address_by_cid($id);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {

                                if ($row) {
                        ?>
                                    <div class="card mb-4 customer_details">
                                        <div class="card py-3" style="border:0 ;box-shadow:3px 2px 10px grey;">
                                            <div class="card-body">
                                                <div class="form-check">
                                                    <div class="row">
                                                        <div class="col-md-6 mb-2 col-6">
                                                            <input class="form-check-input inpaddress" type="radio" name="address"  data-id="<?php echo $row['address_id']; ?>" value="<?php echo $fname; ?><?php echo  $lname; ?>">
                                                            <label class="form-check-label" for="flexRadioDefault1">
                                                                <?php echo $fname; ?> <?php echo  $lname; ?>
                                                            </label>
                                                        </div>
                                                        <div class="col-md-6 col-6 mb-2 d-none text-end btn-edit" id="btn-edit-<?php echo $row['address_id'];?>">
                                                            <a class="customer_detail_edit" href="address_details.php?id=<?php echo $row['address_id']; ?>">EDIT</a>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12 col-12">
                                                            <?php echo $row['houseno']; ?>, <?php echo $row['roadname']; ?> near <?php echo $row['near_place']; ?>,<?php echo $row['city_name']; ?> <?php echo $row['state_name']; ?>,<?php echo $row['country_name']; ?>,<?php echo $row['pincode']; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row mt-3">
                                                        <div class=" d-none btn-delivery d-grid gap-2" id="btn-delivery-<?php echo $row['address_id'];?>">
                                                            <a href="checkout.php" class="btn btn-success" name="submit"><strong>Deliver To this Address</strong></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                        <?php }
                            }
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once("footer.php"); ?>