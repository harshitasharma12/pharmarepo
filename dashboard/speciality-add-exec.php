<?php  require_once("includes/initialize.php");
//   require_login();
  if(is_post_request()) {
    $speciality = [];
    $speciality['name'] = $_POST['name'] ?? '';
    $speciality['description'] = $_POST['description'] ?? '';
    $speciality['includes'] = $_POST['includes'] ?? '';
    $speciality['id'] = $_POST['id'] ?? '';
    $speciality['action'] = $_POST['action'];
    


    $upload_dir = "speciality";
    $id = get_max_id("speciality_doctors");
    // print_r($product); exit;
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $speciality['filename']= $filename;
                  if($speciality['id']>=0 && $speciality['action']==="update")
                  { 
                       
                        $result = speciality_update($speciality);
                  } 
                  else 
                  {
                         $result = speciality_add($speciality);
                  }
                  if($result)
                  {
                      $_SESSION['message'] = 'Speciality'.$speciality['action'].' successfully';
                      $_SESSION['alert'] = 'success';
                      redirect_to("speciality-list.php");
                  }
                  else 
                  {
                    $product = [];
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
    else 
    {
        $product = [];
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
  }
  $_SESSION['message'] = 'Speciality Already Exist';
  $_SESSION['alert'] = 'danger';
  redirect_to("speciality-add.php");
?>