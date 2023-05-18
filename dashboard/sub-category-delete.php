<?php
require_once("includes/initialize.php");
require_login();
if(is_get_request()) {
    $id = [];
    $id=$_GET['id'];

    $result = sub_category_delete($id);
     if($result){
      $_SESSION['message'] = 'Sub-Category Deleted successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("sub-category-list.php");
     }
  } else {

    $id = [];
}
?>