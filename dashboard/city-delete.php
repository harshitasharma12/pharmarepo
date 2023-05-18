<?php
require_once("includes/initialize.php");
require_login();
if(is_get_request()) {
    $id = [];
    $id=$_GET['id'];

    $result = city_delete($id);
     if($result){
      $_SESSION['message'] = 'city Deleted successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("city-list.php");
     }
  } else {

    $id = [];
}
?>