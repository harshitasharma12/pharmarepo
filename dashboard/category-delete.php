<?php
require_once("includes/initialize.php");
require_login();
if(is_get_request()) {
    $id = [];
    $id=$_GET['id'];

    $result = category_delete($id);
     if($result){
      $_SESSION['message'] = 'Category Deleted successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("category-list.php");
     }
  } else {

    $id = [];
}
?>