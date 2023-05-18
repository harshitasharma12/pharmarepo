<?php  require_once("includes/initialize.php");
  require_login();
if(is_post_request()) {
  $upload = [];
  $upload['title'] = $_POST['title'] ?? '';
  $upload['type_id'] = $_POST['type_id'] ?? '';


  $upload_dir = "files";
  $id = get_max_id("uploadform");

  if(!empty($_FILES['file']['name'])){
    if(check_extension($_FILES['file']['name'])){
    if($_FILES["file"]["size"] < 67108864){
      if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id)){
        $upload['filename'] = $filename;
        $result = insert_upload($upload);
        if($result){
          $error = "Upload Added successfully";
          $alert="success";  

        }

      }  else {
        $error = "File not uploaded";
        $alert = "warning";
        }
    } else {
      $error = "Size exceeds";
      $alert = "warning";
    }

    } else {
    $error = "Invalid file";
    $alert = "danger";
    }
  } else {
    $upload = [];
  } 
  $_SESSION['message'] = $error;
  $_SESSION['alert'] = $alert;
  redirect_to("upload-list.php");
   

}  
?>