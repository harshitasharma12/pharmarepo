<?php
require_once("includes/initialize.php");
if(is_post_request()) 
{
    $country = [];
    $country['name'] = $_POST['name'] ?? '';  
    $result = country_add($country);
     if($result){
      $_SESSION['message'] = 'Country Added successfully';
      $_SESSION['alert'] = 'success';
      redirect_to("country-list.php");
     }
  } else {

    $_SESSION['message'] = 'Country Already Exist';
    $_SESSION['alert'] = 'danger';
    redirect_to("country-add.php");

  }