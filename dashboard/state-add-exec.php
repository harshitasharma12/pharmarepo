<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $state = [];
     $state['name'] = $_POST['name'] ?? '';
     $state['country_id'] = $_POST['country_id'] ?? '';
     

     $result = state_add($state);
     if($result){
      $_SESSION['message'] = 'State Added successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("state-list.php");
     }
  } else {

    $_SESSION['message'] = 'State Already Exist';
    $_SESSION['alert'] = 'danger';
    redirect_to("state-add.php");
    //error 

  }
?>