<?php  require_once("dashboard/includes/initialize.php");
  if(is_post_request()) {
    $prescription= [];
    $id = generate_id();
    $upload_dir = "prescription";
    $error="";
    $alert="";
   
     if(!empty($_FILES['file']['name']))
    { 
       if(check_extension_for_pdf($_FILES['file']['name']))
       {
        
          if($_FILES["file"]["size"] < 67108864)
          {
           
           
              if($filename = upload_file($_FILES['file']['tmp_name'], $_FILES['file']['name'], $upload_dir, "0", "0", $id))
              {
                 
                  $prescription['filename']= $filename;
                  // $prescription['order_id']=$id;
                  // print_r($prescription); exit;
                  // $result = prescription_add($prescription);
                  $_SESSION['prescription_filename']=$filename;
                  // $_SESSION['order_id']=$id;
                  redirect_to("cart.php");
                 
                  // if($result)
                  // {
                  //     $_SESSION['message'] = 'Prescription '.$report['action'].' successfully';
                  //     $_SESSION['alert'] = 'success';
                  //     redirect_to("cart.php");
                  // }
                  // else 
                  // {
                  //   $prescription = [];
                  //  }
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
          $error = "Invalid file please upload file in Pdf extension";
          $alert = "danger";
       }
    } 
    else {
      //update
      $prescription = [];
     
    } 
    $_SESSION['message'] = $error;
    $_SESSION['alert'] = $alert;
    redirect_to("cart.php");
  
  }
?>