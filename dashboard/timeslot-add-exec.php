<?php  require_once("includes/initialize.php");
  if(is_post_request()) {
    $timeslot = [];
    $timeslot['from'] = $_POST['from'] ?? '';
    $timeslot['to'] = $_POST['to'] ?? '';
    $timeslot['doctor_id'] = $_POST['doctor_id'] ?? '';
    $timeslot['id'] = $_POST['id'] ?? '';
    $timeslot['action'] = $_POST['action'];

    if($timeslot['id']>=0 && $timeslot['action']==="update")
    {
        $result = timeslot_update($timeslot);
    } 
    else 
    {
        $result = timeslot_add($timeslot);
    }
    if($result)
    {
        $_SESSION['message'] = 'Timeslot '.$timeslot['action'].' successfully';
        $_SESSION['alert'] = 'success';
        redirect_to("timeslot-list.php");
    }
  }
  else 
  {
    $timeslot = [];
  }
  ?>