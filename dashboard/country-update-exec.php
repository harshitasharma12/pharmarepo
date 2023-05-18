<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $country= [];
     $country['name'] = $_POST['name'] ?? '';
     $country['id'] = $_POST['id'] ?? '';
 
     $result = country_update($country);
     if($result){
      $_SESSION['message'] = 'Country Updated successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("country-list.php");
     }
  } else {

    $country = [];
    //error 

  }
?>