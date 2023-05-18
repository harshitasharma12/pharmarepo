<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $sub_category = [];
     $sub_category['name'] = $_POST['name'] ?? '';
     $sub_category['category'] = $_POST['category'] ?? '';
     

     $result = insert_sub_category($sub_category);
     if($result){
      $_SESSION['message'] = 'Sub-Category Added successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("sub-category-list.php");
     }
  } else 
  {
          $_SESSION['message'] = 'Sub Category Already Exist';
          $_SESSION['alert'] = 'danger';
          redirect_to("sub-category-add.php");
     
  }
?>