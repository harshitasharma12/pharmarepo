<?php  require_once("includes/initialize.php");
  require_login();
  $page = "change-password.php";
  if(is_post_request()) {
    $username = $_SESSION['username'];
    $password['current_password'] = $_POST['current_password'];
    $password['password'] = $_POST['password'];
    $password['confirm_password'] = $_POST['confirm_password'];
    $password['role'] = $_SESSION['role'];

    $check= change_password_validate($password);
    // print_r($check);
    // exit;
    if(empty($check)){
        
      $result = change_password($username, $password);
      if($result===true){
        $_SESSION['message'] = "Password change successfully";
        $_SESSION['alert'] = "success";
        $_SESSION['error'] = NULL;
      } else {
        $_SESSION['message']  = display_errors($result);
        $_SESSION['alert'] = "danger";
      }
      redirect_to($page);
    }
    else
    {
        $_SESSION['message'] = 'Incorrect data';
        $_SESSION['error'] = $check;
        $_SESSION['alert'] = 'danger';
        redirect_to("change-password.php");
    }
  }
    
    
