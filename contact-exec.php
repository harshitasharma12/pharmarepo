<?php  require_once("dashboard/includes/initialize.php");
 // require_login();
  if(is_post_request()) {
    $contact = [];
     $contact['name'] = $_POST['name'] ?? '';
     $contact['phone'] = $_POST['phone'] ?? '';
    $contact['email'] = $_POST['email'] ?? '';
    $contact['query'] = $_POST['query'] ?? '';

    
     
     $result = contact_add($contact);
     if($result){
      $_SESSION['message'] = 'Message Send successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("index.php");
     }
  } else {

    $contact = [];
    //error 

  }
?>