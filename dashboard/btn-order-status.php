<?php
    switch ($status_id) {
        case '1':
?>
    <a href="view_product_details.php?order_no=<?php echo $order['order_no'];?>" class="btn btn-primary"> View Detail</a>
<?php            
            break;
        case '2':
?>
        <a href="deliver_product.php?order_no=<?php echo $order['order_no'];?>" class="btn btn-primary"> Deliver</a>
<?php
            break;
?>
<?php    case '3':
            echo "Cancelled";
            break;
        case '4':
            echo "Return";
            break;
        case '5':
            echo "Delivered";
            break;
        default:
            # code...
            break;
    }
?>
