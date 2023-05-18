<?php 
function log_in_customer($customer) {
    $_SESSION['customer_id'] = $customer['id'];
    $_SESSION['customer_fname'] = $customer['first_name'];
    $_SESSION['customer_lname'] = $customer['last_name'];
    $_SESSION['customer_email'] = $customer['email'];
    $_SESSION['customer_contact'] = $customer['contact'];
    $_SESSION['customer_country']= $customer['country_id'];  
    $_SESSION['default_address_id']=$customer['default_address_id'];
    $_SESSION['confirm'] = $customer['confirm'];
    return true;
  }

  function log_out_customer(){
    unset($_SESSION['customer_id']);
    return true;
  }

  function is_logged_in_customer() {
    return isset($_SESSION['customer_id']);
    
  }

  function get_customer_id(){
    if(is_logged_in_customer()){
        return $_SESSION['customer_id'];
    } else {
        return 0;
    }
  }

  function get_customer_name(){
    if(is_logged_in_customer()){
        return trim($_SESSION['customer_fname']." ".$_SESSION['customer_lname']);
    } else {
        return "Guest";
    }
  }

  function get_customer_contact(){
    if(is_logged_in_customer()){
        return trim($_SESSION['customer_contact']);
    } else {
        return 0;
    }
  }

  function get_customer_country(){
    if(is_logged_in_customer()){
        return trim($_SESSION['customer_country']);
    } else {
        return 0;
    }
  }

  function get_customer_email(){
    if(is_logged_in_customer()){
        return trim($_SESSION['customer_email']);
    } else {
        return 0;
    }
  }

  function is_customer_confirm(){
    if(is_logged_in_customer()){
      if(isset($_SESSION['confirm'])){
        if($_SESSION['confirm']==="1"){
          return true;
        } else {
          return false;
        }
      }
    }
    return false;
  }

  function get_customer_confirm(){
    if(!is_customer_confirm()) {
      $_SESSION['message'] = "Your account is not activated.";
      $_SESSION['alert']="danger";
      //log_out_customer();
      redirect_to(('verify-now.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }


?>