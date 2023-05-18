<?php
require_once("includes/initialize.php");
if (change_status_alltimeslot()) {
    redirect_to("timeslot-list.php");
} else {
    redirect_to("timeslot-list.php");
}
?>
