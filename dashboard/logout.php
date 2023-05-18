<?php
require_once('includes/initialize.php');
$url="admin-login.php";
if(is_admin()){
    $url = "admin-login.php";
} else if(is_doctor()) {
    $url = "doctor-login.php";
}
log_out_admin();
redirect_to($url);

?>
