<?php  require_once("includes/initialize.php");
  require_login();
  if(is_post_request()) {
    $brand = [];
    $brand['name'] = $_POST['name'] ?? '';
    $brand['id'] = $_POST['id'] ?? '';
    $brand['action'] = $_POST['action'];

    $upload_dir = "brand";
    $id = get_max_id("brand");
    // print_r($product); exit;
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $brand['filename']= $filename;
                  if($brand['id']>=0 && $brand['action']==="update")
                  { 
                       
                        $result = brand_update($brand);
                  } 
                  else 
                  {
                         $result = brand_add($brand);
                  }
                  if($result)
                  {
                      $_SESSION['message'] = 'Brand '.$brand['action'].' successfully';
                      $_SESSION['alert'] = 'success';
                      redirect_to("brand-list.php");
                  }
                  else 
                  {
                    $brand = [];
                   }
              }
              else 
              {
                  $error = "File not uploaded";
                  $alert = "warning";
              }
          } 
          else 
          {
             $error = "Size exceeds";
             $alert = "warning";
          }
       } 
       else 
       {
          $error = "Invalid file";
          $alert = "danger";
       }
    } 
    else {
      //update
      $result = brand_update($brand);
      if($result){
        $error = "Upload Added successfully";
        $alert="success";  

      }
      $upload = [];
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
  }
  else 
  {
          $_SESSION['message'] = 'Brand Already Exist';
          $_SESSION['alert'] = 'danger';
          redirect_to("brand-add.php");
     
  }
?>