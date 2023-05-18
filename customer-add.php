<?php require_once("dashboard/includes/initialize.php"); ?>
<?php $errors = array("dd" => "abc"); ?>
<?php $page_title = 'Customer Profile';  ?>
<?php $page = "customer-add-exec.php"; ?>
<?php require_once("header.php"); ?>
<?php

$customer = customer_select_by_id(get_customer_id());
if (is_array($customer)) {
    $first_name = $customer['first_name'];
    $last_name = $customer['last_name'];
    $email = $customer['email'];
    $contact = $customer['contact'];
    $country_id = $customer['country_id'];
    $id = $customer['id'];
}
if (isset($_POST['submit'])) {
    $id = get_customer_id();
    $customer = customer_select_by_id(get_customer_id());
    if (is_array($customer)) {
        $first_name = $customer['first_name'];
        $last_name = $customer['last_name'];
        $email = $customer['email'];
        $contact = $customer['contact'];
        $country_id = $customer['country_id'];
        $id = $customer['id'];
    }
}
?>
<main>
    <div class="container-fluid px-4">

        <div class="row">
            <div class="col-md-6 col-10 col-sm-10 mx-auto mt-3">


                <?php echo display_session_message(); ?>
                <?php if (array_key_exists("error", $_SESSION)) {
                    $errors = $_SESSION["error"];

                ?>

                <?php } ?>
                <div class="card mb-4 mt-5" style="border-radius:0px;box-shadow:5px 6px 10px grey;">

                    <div class="card-body">
                        <h5>Edit Profile</h5>
                        <hr>
                        <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">

                            <input type="hidden" name="id" value="<?php echo $id; ?>">


                            <div class="row">

                                <div class="col-md-9 mx-auto">

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="First Name" value="<?php echo $first_name; ?>" style="border-radius:0px;">
                                        <label for="floatingInput">First Name</label>
                                        <?php if (!empty($errors) && array_key_exists("first_name", $errors)) { ?>
                                            <span id="error" style="color:red;"><?php echo $errors["first_name"]; ?></span>

                                        <?php } ?>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Last Name" value="<?php echo $last_name; ?>" style="border-radius:0px;">
                                        <label for="floatingInput">Last Name</label>
                                        <?php if (!empty($errors) && array_key_exists("last_name", $errors)) { ?>
                                            <span id="error" style="color:red;"><?php echo $errors["last_name"]; ?></span>
                                        <?php } ?>
                                    </div>

                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email" readonly placeholder="Email Address " value="<?php echo $email; ?>" style="border-radius:0px;">
                                        <label for="floatingInput">Email address</label>
                                    </div>


                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="contact" name="contact" required placeholder="Contact Number" value="<?php echo $contact; ?>" style="border-radius:0px;">
                                        <label for="floatingInput">Contact Number</label>
                                        <?php if (!empty($errors) && array_key_exists("contact", $errors)) { ?>
                                            <span id="error" style="color:red;"><?php echo $errors["contact"]; ?></span>
                                        <?php } ?>
                                    </div>


                                    <select name="country_id" class="form-select" id="country_id" style="border-radius:0px;">
                                        <option value="0">Country Name</option>
                                        <?php
                                        $result_set = country_select();
                                        while ($result = mysqli_fetch_array($result_set)) { ?>
                                            <option value="<?php echo $result['id']; ?>" <?php if ($result['id'] == $country_id) echo "selected"; ?> style="border-radius:0px;"><?php echo $result['name']; ?></option>
                                        <?php } ?>
                                    </select>



                                    <div class="d-grid gap-2 mt-4">
                                        <button type="submit" class="btn btn-success" name="submit">Save Details</button>
                                    </div>
                        </form>
                        <div class="d-grid gap-2 mt-3 mb-4">
                            <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                Change Password
                            </button>
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="change-password.php" method="POST" enctype="multipart/form-data">
                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="floatingPassword" required name="oldpassword" placeholder="Password">
                                                    <label for="floatingPassword">Old Password</label>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="floatingPassword" required name="password" placeholder="Password">
                                                    <label for="floatingPassword">New Password</label>
                                                    <?php if (!empty($errors) && array_key_exists("password", $errors)) { ?>
                                                        <span id="error" style="color:red;"><?php echo $errors["password"]; ?></span>

                                                    <?php } ?>
                                                </div>

                                                <div class="form-floating mb-3">
                                                    <input type="password" class="form-control" id="floatingPassword" required name="confirmpassword" placeholder="Password">
                                                    <label for="floatingPassword">Confirm New Password</label>
                                                </div>

                                                <div class="modal-footer">

                                                    <button name="submit" class="btn btn-outline-success">Submit</button>
                                                    <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Close</button>

                                                </div>
                                            </form>
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
</main>
<?php require_once("footer.php"); ?>