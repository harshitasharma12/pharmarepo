<?php require_once("header.php"); ?>
<?php $customer_name = get_customer_name(); ?>
<?php $customer_contact = get_customer_contact(); ?>
<?php $customer_id = get_customer_id(); ?>
<?php $customer_email = get_customer_email(); ?>
<?php $appoinments = show_customer_appoinment($customer_id); ?>
<div class="container">
    <div class="row">
        <?php while ($appoinment = mysqli_fetch_assoc($appoinments)) { ?>
            <div class="col-md-4">
                <div class="card mt-4">
                    <img src="dashboard/uploads/doctors/<?php echo $appoinment['filename']; ?>" class="card-img-top">
                    <div class="card-body" style="background-color:#47835f;color:white;">
                        <h5 class="card-title text-center"><?php echo $appoinment['doctors_name']; ?></h5>
                        <div class="card-text  text-center"><?php echo $appoinment['education']; ?></div>
                        <!-- <div class="card-text text-center"><?php echo $appoinment['experience']; ?>|&nbsp;&nbsp;You Pay: &#8377; <?php echo $appoinment['pay_price']; ?></div> -->
                        <div class="card-text text-center">Speciality in :&nbsp;<?php echo $appoinment['speciality_name']; ?></div>
                    </div>
                </div>
            </div>


            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title text-center">Customer Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="name" class="form-control" id="floatingInput" readonly value="<?php echo $customer_name; ?>">
                                    <label for="floatingInput">Name</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="number" class="form-control" id="floatingInput" readonly value="<?php echo $customer_contact; ?>">
                                    <label for="floatingInput">Contact Number</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" id="floatingInput" readonly value="<?php echo $appoinment['from_time']; ?>">
                                    <label for="floatingInput">Appoinment From</label>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="floatingInput" readonly value="<?php echo $customer_email; ?>">
                                    <label for="floatingInput">UserName</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control" id="floatingInput" readonly value="<?php echo $appoinment['google_id']; ?>">
                                    <label for="floatingInput">Meeting Link</label>
                                </div>

                                <div class="form-floating mb-3">
                                    <input type="time" class="form-control" id="floatingInput" readonly value="<?php echo $appoinment['to_time']; ?>">
                                    <label for="floatingInput">Appoinment to</label>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-6 mx-auto">
                        <div class="form-floating mb-1">
                                    <input type="text" class="form-control" id="floatingInput" readonly value="<?php echo datetime_to_text($appoinment['date']); ?>">
                                    <label for="floatingInput">Appoinment Date</label>
                                </div>
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="mb-1">
                                    <label for="remarks" class="form-label">Remarks</label>
                                    <textarea name="remarks" id="" cols="30" rows="5" class="form-control"><?php echo $appoinment['remarks']; ?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            </div>
        <?php } ?>
    </div>

</div>
<?php require_once("footer.php");?>