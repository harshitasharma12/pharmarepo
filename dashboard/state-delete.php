<?php
require_once("includes/initialize.php");
require_login();
if(is_get_request()) {
    $id = [];
    $id=$_GET['id'];

    $result = state_delete($id);
     if($result){
      $_SESSION['message'] = 'State Deleted successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("state-list.php");
     }
  } else {

    $id = [];
}
?>