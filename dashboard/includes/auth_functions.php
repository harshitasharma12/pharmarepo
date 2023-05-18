<?php

  // Performs all actions necessary to log in an admin
  function log_in_admin($admin) {
  // Renerating the ID protects the admin from session fixation.
    session_regenerate_id();
    $_SESSION['admin_id'] = $admin['id'];
   // $_SESSION['last_login'] = time();
    $_SESSION['role'] = $admin['role'];
    $_SESSION['confirm'] = $admin['confirm'];
    $_SESSION['username'] = $admin['username'];
    return true;
  }

  

  // Performs all actions necessary to log out an admin
  function log_out_admin() {
    unset($_SESSION['admin_id']);
    unset($_SESSION['last_login']);
    unset($_SESSION['username']);
    unset($_SESSION['role']);
    unset($_SESSION['confirm']);
    session_destroy(); // optional: destroys the whole session
    return true;
  }

  


  // is_logged_in() contains all the logic for determining if a
  // request should be considered a "logged in" request or not.
  // It is the core of require_login() but it can also be called
  // on its own in other contexts (e.g. display one link if an admin
  // is logged in and display another link if they are not)
  function is_logged_in() {
    // Having a admin_id in the session serves a dual-purpose:
    // - Its presence indicates the admin is logged in.
    // - Its value tells which admin for looking up their record.
    return isset($_SESSION['admin_id']);
  }



  

  // Call require_login() at the top of any page which needs to
  // require a valid login before granting acccess to the page.
  function require_login() {
    if(!is_logged_in()) {
      redirect_to(('logout.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

  function is_admin(){
    if(is_logged_in()){
      if(isset($_SESSION['role'])){
        if($_SESSION['role']=="1"){
          return true;
        }
      }
    }
    return false;
  }

  function is_doctor(){
    if(is_logged_in()){
      if(isset($_SESSION['role'])){
        if($_SESSION['role']=="2"){
          return true;
        }
      }
    }
    return false;
  }


  function is_confirm(){
    if(is_logged_in()){
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

  function require_confirm(){
    if(!is_confirm()) {
      $_SESSION['message'] = "Your account is not activated. Please contact admin.";
      $_SESSION['alert']="danger";
      log_out_admin();
      
      redirect_to(('logout.php'));
    } else {
      // Do nothing, let the rest of the page proceed
    }
  }

 

?>
