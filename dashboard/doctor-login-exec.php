<?php 
	require_once("includes/initialize.php"); 

	$errors = [];
	$username = '';
	$password = '';

	if(is_post_request()) {

	  $username = $_POST['username'] ?? '';
	  $password = $_POST['password'] ?? '';

	  // Validations
	  if(is_blank($username)) {
	    $errors[] = "Username cannot be blank.";
	  }
	  if(is_blank($password)) {
	    $errors[] = "Password cannot be blank.";
	  }

	  // if there were no errors, try to login
	  if(empty($errors)) {
	    // Using one variable ensures that msg is the same
	    $login_failure_msg = "Log in was unsuccessful.";

	    $doctor = find_doctor_by_username($username);

	    if($doctor) {
	      if(password_verify($password, $doctor['hpassword'])) {

	        // password matches
	        $doctor['username'] = $doctor['email'];
			$doctor['confirm'] ="1";
	        log_in_admin($doctor);

	        //require_confirm();
	       
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
	$_SESSION['message'] = display_errors($errors);
	$_SESSION['alert'] = "danger";
	redirect_to('doctor-login.php');
?>