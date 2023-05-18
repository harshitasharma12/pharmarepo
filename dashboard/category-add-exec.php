<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $category = [];
     $category['name'] = $_POST['name'] ?? '';
     

     $result = insert_category($category);
     if($result){
      $_SESSION['message'] = 'Category Added successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("category-list.php");
     }
  } else 
  {
          $_SESSION['message'] = 'Category Already Exist';
          $_SESSION['alert'] = 'danger';
          redirect_to("category-add.php");
     
  }
?>