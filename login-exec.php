<?php 
	require_once("dashboard/includes/initialize.php"); 

	$errors = [];
	$email = '';
	$password = '';

	if(is_post_request()) {

	  $email = $_POST['email'] ?? '';
	  $password = $_POST['password'] ?? '';

	  // Validations
	  if(is_blank($email)) {
	    $errors[] = "Username cannot be blank.";
	  }
	  if(is_blank($password)) {
	    $errors[] = "Password cannot be blank.";
	  }

	  // if there were no errors, try to login
	  if(empty($errors)) {
	    // Using one variable ensures that msg is the same
	    $login_failure_msg = "Log in was unsuccessful.";

	    $customer = find_customer($email);

	    if($customer) {

	      if(password_verify($password, $customer['hpassword'])) {

	        // password matches
	        
	        log_in_customer($customer);

	        get_customer_confirm();
	       
	        redirect_to('index.php');
	      } else {
	        // username found, but password does not match
	        $errors[] = $login_failure_msg;
	      }

	    } else {
	      // no username found
	      $errors[] = $login_failure_msg;
	    }

	  }

	} else {
		echo "dd";
	}
	$_SESSION['message'] = $login_failure_msg;
	$_SESSION['alert'] = "danger";
	redirect_to('login.php');
?>