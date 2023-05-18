<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $city = [];
     $city['name'] = $_POST['name'] ?? '';
     $city['state_id'] = $_POST['state_id'] ?? '';

     

     $result = city_add($city);
     if($result){
      $_SESSION['message'] = 'City Added successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("city-list.php");
     }
  } else {

    $_SESSION['message'] = 'City Already Exist';
    $_SESSION['alert'] = 'danger';
    redirect_to("city-add.php");

  }
?>