<?php  require_once("includes/initialize.php");
  
  if(isset($_POST['submit']))
  {
      $meet = $_POST;
      if( meet_update($meet))
      {
          redirect_to("appoinment-list.php");
      }
      else
      {
          redirect_to("googlemeet-add.php");
      }
  }
  ?>