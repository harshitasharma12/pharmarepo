<?php  require_once("dashboard/includes/initialize.php");
  if(is_post_request()) {
    $customer = [];
    $customer['first_name'] = $_POST['first_name'] ?? '';
    $customer['last_name'] = $_POST['last_name'] ?? '';
    $customer['contact'] = $_POST['contact'] ?? '';
    $customer['country_id'] = $_POST['country_id'] ?? '';
    $customer['id'] = $_POST['id'] ?? '';
    $check=update_validate_user($customer);
    if(empty($check)){
    $result = customer_update($customer);
    if($result)
    {
        $_SESSION['message'] = 'Customer Profile Updated successfully';
        $_SESSION['alert'] = 'success';    
        $_SESSION['customer_fname'] = $customer['first_name'];
        $_SESSION['customer_lname'] = $customer['last_name'];
        $_SESSION['customer_contact'] = $customer['contact'];
        $_SESSION['country']=$customer['country'];
        $_SESSION['error'] = NULL;
        redirect_to("customer-add.php");
    }
  }
  else{
    $_SESSION['message'] = 'Incorrect data';
    $_SESSION['error'] = $check;
    $_SESSION['alert'] = 'danger';
    redirect_to("customer-add.php");
  }
}
  else 
  {
    $customer = [];
  }
