<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $user = [];
     $user['name'] = $_POST['name'] ?? '';
     $user['password'] = $_POST['password'] ?? '';
     $user['confirm_password'] = $_POST['confirm_password'] ?? '';

     if($user['password']!==$user['confirm_password']){
      $_SESSION['message'] = 'Password not matched.';
      $_SESSION['alert'] = 'warning';
      redirect_to("user-add.php");
     }

     $result = insert_user($user);
     if($result){
      $_SESSION['message'] = 'User Added successfully with image.';
      $_SESSION['alert'] = 'success';
      redirect_to("user-all.php");
     }
  } else {

    $user = [];
    //error 

  }
?>