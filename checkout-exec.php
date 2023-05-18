<?php  require_once("dashboard/includes/initialize.php");
  if(is_post_request()) {
  $payment=$_POST['payment'];
  $contact = $_POST['contact'];
  $prescription=false;
  if(isset($_SESSION['prescription_filename']) && !empty($_SESSION['prescription_filename']))
  {
    $prescription=$_SESSION['prescription_filename'];
  }
  $order=[];
  $order_detail=[];
  $report=[];

  if(is_logged_in_customer()){
    if($contact!=get_customer_contact())
    {
        redirect_to("login.php");
    }
    else
    {
    $customer_id = get_customer_id();
    $cart = show_details_in_cart($customer_id);
    foreach($cart as $key => $item){
      if($item['product_type']=="medicines" && $item['prescription']=="Yes" && $prescription==false)
      {
        $_SESSION['message'] = 'Prescription required please upload';
        $_SESSION['alert'] = 'danger';
        redirect_to("cart.php");
      }
    }
    $customer = customer_select_by_id($customer_id);
    $order['order_no']= $_SESSION['order_id'];
    $order['customer_id']=get_customer_id();
    $order['customer_name']= get_customer_name($customer_id);
    $order['customer_contact'] = get_customer_contact($customer_id);
    $row = get_address_of_customer($customer['default_address_id']);
    $order['address']=$row['address'];
    // $order['delivery_charges'] = "0";
  //  insert query
    $result=order_detail($order);
    foreach($cart as $key => $item){
        $order_detail['order_id'] = $order['order_no'];
        $order_detail['product_id']=$item['product_id'];
        $order_detail['product_name'] = $item['name'];
        $order_detail['product_type']=$item['product_type'];
        
        $order_detail['quantity'] = $item['quantity'];
        $order_detail['price'] = $item['price'];
        $order_detail['discount'] = $item['discount'];
        $order_detail['filename']=$prescription;
        
       
        $order_detail['payment_mode']=$payment;
        //insert query to order_detail table
      $result1= order_product($order_detail);
      
    }
      $order_history['order_no']=$_SESSION['order_id'];
      $order_history['status_id'] ="1";
      $order_history_result=order_history_add($order_history);
    // empty cart by customer_id
    $result=delete_cart_by_customer($customer_id);
    }
    if($result)
    {
        // $_SESSION['message'] = 'Order Added successfully';
        // $_SESSION['alert'] = 'success';
        $_SESSION['prescription_filename']=NULL;
        redirect_to("placed-order.php");
    }

  }

}
?>