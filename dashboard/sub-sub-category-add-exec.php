<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {
    $sub_sub_category = [];
    $sub_sub_category['name'] = $_POST['name'] ?? '';
    $sub_sub_category['sub_category_id'] = $_POST['sub_category_id'] ?? '';
    $sub_sub_category['id'] = $_POST['id'] ?? '';
    $sub_sub_category['action'] = $_POST['action'];

    if($sub_sub_category['id']>=0 && $sub_sub_category['action']==="update")
    {
        $result = subsub_category_update($sub_sub_category);
    } 
    else 
    {
        $result = subsub_category_add($sub_sub_category);
    }
    if($result)
    {
        $_SESSION['message'] = 'Sub Sub Category '.$sub_sub_category['action'].' successfully';
        $_SESSION['alert'] = 'success';
        redirect_to("sub-sub-category-list.php");
    }
  }
  else 
  {
          $_SESSION['message'] = 'Sub Sub Category Already Exist';
          $_SESSION['alert'] = 'danger';
          redirect_to("sub-sub-category-add.php");
     
  }
  ?>