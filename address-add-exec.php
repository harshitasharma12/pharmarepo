<?php  require_once("header.php");
  if(is_post_request()) {

    $address = [];
    $address['customer_id'] = $_POST['customer_id'] ?? '';
     $address['houseno'] = $_POST['houseno'] ?? '';
     $address['roadname'] = $_POST['roadname'] ?? '';
     $address['state_id'] = $_POST['state_id'] ?? '';
     $address['city_id'] = $_POST['city_id'] ?? '';
     $address['pincode'] = $_POST['pincode'] ?? '';
     $address['near_place'] = $_POST['near_place'] ?? '';
     $address['id'] = $_POST['id'] ?? '';
     $address['action'] = $_POST['action'];
 
     if($address['id']>=0 && $address['action']==="Update")
     {
         $result = address_update($address);
     } 
     else 
     {
         $result = address_add($address);
     }
     if($result)
     {
         $_SESSION['message'] = 'Address '.$address['action'].' successfully';
         $_SESSION['alert'] = 'success';
         redirect_to("customer-details.php");
     }
   }
   else 
   {
     $address = [];
   }
?>