<?php  require_once("includes/initialize.php");
if(isset($_GET['id']))
{
    $id=$_GET['id'];
    if(availablity($id))
    {
        redirect_to("product-list.php");
    }
    else
    {
        redirect_to("product-list.php");
    }
}
?>