<?php require_once("includes/initialize.php"); ?>
<?php require_login(); ?>
<?php $errors = array("dd" => "abc"); ?>
<?php $page = "change-password-exec.php"; ?>
<?php $page_title = 'Change Password'; ?>
<?php require_once("header.php"); ?>
<?php $mode = "user"; ?>
<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Password</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Change Password </li>
    </ol>
    
    <?php echo display_session_message(); ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-key me-1"></i>
            Change Your Password
          </div>
          <?php if (array_key_exists("error", $_SESSION)) {
            $errors = $_SESSION["error"];

          ?>

          <?php } ?>
          <div class="card-body">
            <form id="form_profile" action="<?php echo $page; ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="mode" value="<?php echo $mode; ?>">
              <div class="row">
                <div class="col-xl-12">
                  <?php if ($mode == "user") { ?>
                    <div class="mb-3">
                      <label for="name" class="form-label">Current Password</label>
                      <input type="password" class="form-control" id="current_password" name="current_password" required>
                    </div>
                  <?php } else { ?>
                    <input type="hidden" name="username" value="<?php echo $username; ?>">
                  <?php } ?>

                  <div class="mb-3">
                    <label for="name" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="password" required minlength="6">
                    <?php if (!empty($errors) && array_key_exists("password", $errors)) { ?>
                      <span id="error" style="color:red;"><?php echo $errors["password"]; ?></span>
                    <?php } ?>
                  </div>
                  <div class="mb-3">
                    <label for="name" class="form-label">Confirm Password</label>
                    <input type="password" minlength="6" class="form-control" id="confirm_password" name="confirm_password" required>
                  </div>
                  <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                  <button type="reset" class="btn btn-danger" name="reset">Reset</button>
                </div>

              </div>

            </form>

          </div>
        </div>
      </div>

    </div>

  </div>
</main>
<?php exit; ?>
<?php require_once("footer.php"); ?>