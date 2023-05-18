<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $sub_category = [];
     $sub_category['name'] = $_POST['name'] ?? '';
     $sub_category['category'] = $_POST['category'] ?? '';
     $sub_category['id'] = $_POST['id'] ?? '';
     

     $result = sub_category_update($sub_category);
     if($result){
      $_SESSION['message'] = 'Sub-Category Updated successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("sub-category-list.php");
     }
  } else {

    $category = [];
    //error 

  }
?>