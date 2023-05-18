<?php
 require_once("header.php");
 if(isset($_GET['submit']))
 {
    $return=$_GET;
    if(return_reason($return))
    {
        redirect_to("my_orders.php");
    }
    else
    {
        redirect_to("index.php");
    }


 }
 if(isset($_GET['order_id']))
 {
     $status['order_id']=$_GET['order_id'];
     $status['status_id']=$_GET['cancel_id'];
     $status['order_no']=$_GET['order_no'];
     if(status_update($status))
     {  
        $order_history['order_no']= $status['order_no'];
        $order_history['status_id'] =$status['status_id'];
        //insert_order_history($order_history);
        $result=order_history_add($order_history);
         redirect_to("my_orders.php");
     }
     else
     {
         redirect_to("my_orders.php");
     }
 }
?>