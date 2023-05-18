<?php require_once("dashboard/includes/initialize.php");
if (is_post_request()) {
    $customer = [];
    $customer['first_name'] = $_POST['first_name'] ?? '';
    $customer['last_name'] = $_POST['last_name'] ?? '';
    $customer['email'] = $_POST['email'] ?? '';
    $customer['password'] = $_POST['password'] ?? '';
    $customer['contact'] = $_POST['contact'] ?? '';
    $customer['country_id'] = $_POST['country_id'] ?? '';
    
    $expFormat = mktime(date("H"), date("i"), date("s"), date("m") ,date("d")+1, date("Y"));
    $expDate = date("Y-m-d H:i:s",$expFormat);
    $key = encryption($customer['email']);

    $customer['verify_key'] = $key;
    $customer['expDate'] = $expDate;

    $check=validate_user($customer);
    if(empty($check)){
        
        $result = customer_add($customer);
        if ($result) {
            mail_for($customer['email'], $customer['email'], $customer['password'], "Welcome Message", "welcome-customer");
        // $_SESSION['message'] = 'Customer Added and Verification OTP sent to your mail';
        $_SESSION['message'] = 'Customer Added Successful';
        $_SESSION['alert'] = 'success';
        $_SESSION['error'] = NULL;
        redirect_to("login.php");
    }
    }else
    {
        $_SESSION['message'] = 'Incorrect data';
        $_SESSION['error'] = $check;
        $_SESSION['alert'] = 'danger';
        redirect_to("register.php");
    }
    
} 
else 
{
        $_SESSION['message'] = 'Customer Already Exist';
        $_SESSION['alert'] = 'danger';
        $_SESSION['error'] = NULL;
        redirect_to("register.php");
   
}
