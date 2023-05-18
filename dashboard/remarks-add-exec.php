<?php  require_once("includes/initialize.php");
  
  if(isset($_POST['submit']))
  {
      $meet = $_POST;
      if( remarks_update($meet))
      {
          redirect_to("appoinment-list.php");
      }
      else
      {
          redirect_to("remarks-add.php");
      }
  }
  ?>