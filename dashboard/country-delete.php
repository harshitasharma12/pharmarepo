<?php
require_once("includes/initialize.php");
require_login();
if(is_get_request()) {
    $id = [];
    $id=$_GET['id'];

    $result = country_delete($id);
     if($result){
      $_SESSION['message'] = 'Country Deleted successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("country-list.php");
     }
  } else {

    $id = [];
}
?>