<?php  require_once("includes/initialize.php");
//   require_login();
  if(is_post_request()) {
    $labtest = [];
    $labtest['name'] = $_POST['name'] ?? '';
    $labtest['also_known'] = $_POST['also_known'] ?? '';
    $labtest['report'] = $_POST['report'] ?? '';
    $labtest['price'] = $_POST['price'] ?? '';
    $labtest['test_include'] = $_POST['test_include'] ?? '';
    $labtest['test_name'] = $_POST['test_name'] ?? '';
    $labtest['about'] = $_POST['about'] ?? '';
    $labtest['gender'] = $_POST['gender'] ?? '';
    $labtest['age_group'] = $_POST['age_group'] ?? '';
    $labtest['sample'] = $_POST['sample'] ?? '';
    $labtest['id'] = $_POST['id'] ?? '';
    $labtest['action'] = $_POST['action'];
    


    $upload_dir = "labtest";
    $id = get_max_id("labtest");
    // print_r($product); exit;
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $labtest['filename']= $filename;
                  if($labtest['id']>=0 && $labtest['action']==="Update")
                  { 
                       
                        $result = labtest_update($labtest);
                  } 
                  else 
                  {
                         $result = labtest_add($labtest);
                  }
                  if($result)
                  {
                      $_SESSION['message'] = 'labtest '.$labtest['action'].' successfully';
                      $_SESSION['alert'] = 'success';
                      redirect_to("labtest-list.php");
                  }
                  else 
                  {
                    $doctor = [];
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
        $labtest = [];
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
  }
  $_SESSION['message'] = 'Lab test Already Exist';
  $_SESSION['alert'] = 'danger';
  redirect_to("labtest-add.php");
?>