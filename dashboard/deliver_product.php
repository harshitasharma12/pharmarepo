<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php
if(is_get_request())
{
    $order_no=$_GET['order_no'];
    $order = order_by_orderno($order_no);
    $status['order_id'] = $order['id'];
    $status['status_id'] = "5";
    $status['order_no']=$order['order_no'];
    status_update($status);
    // $order_history=[];
    // $order_history=$_GET['order_no'];
    // $order_history=$status['status_id'];
    $order_history_result=order_history_add($status);
    redirect_to("order-list.php?id=".$status['status_id']);
} 


?>
