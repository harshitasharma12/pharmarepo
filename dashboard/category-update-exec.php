<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {

    $category = [];
     $category['name'] = $_POST['name'] ?? '';
     $category['id'] = $_POST['id'] ?? '';
 
     $result = category_update($category);
     if($result){
      $_SESSION['message'] = 'Category Updated successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("category-list.php");
     }
  } else {

    $category = [];
    //error 

  }
?>