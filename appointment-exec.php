<?php  require_once("dashboard/includes/initialize.php");
if(isset($_POST['submit']))
{
    $appoint = $_POST;
    if(appoinment_insert($appoint))
    {
        if(change_status($appoint))
        {
            redirect_to("consult.php");
        }    
    }
    else
    {
        redirect_to("consult.php");
    }
}
?>

