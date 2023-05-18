<?php require_once("dashboard/includes/initialize.php");
$page = "customer-add.php";
if (is_post_request()) {
  $password = [];
  $username = get_customer_email();
  $password['oldpassword'] = $_POST['oldpassword'];
  $password['password'] = $_POST['password'];
  $password['confirmpassword'] = $_POST['confirmpassword'];
  $check = change_password_validate($password);
  // print_r($check);
  // exit;
  if (empty($check)) {
    $result = change_password_customer($username, $password);
    if ($result === true) {
      $_SESSION['message'] = "Password change successfully";
      $_SESSION['alert'] = "success";
       $_SESSION['error'] = NULL;
    } else {
      $_SESSION['message']  = display_errors($result);
      $_SESSION['alert'] = "danger";
    }
    redirect_to($page);
  } else {
    $_SESSION['message'] = "Password does not match the format";
    $_SESSION['error'] = $check;
    $_SESSION['alert'] = 'danger';
    redirect_to("customer-add.php");
  }
}
