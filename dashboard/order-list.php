<?php  require_once("includes/initialize.php"); ?>
<?php  require_login(); ?>
<?php 
$current_staus = "";
    if(isset($_GET['id'])){
        $status_id = $_GET['id'];
        $current_status = get_order_status_name($status_id);
    }
?>
<?php 
    if(isset($_POST['btnStatus'])){
        $order_status['order_id'] = $_POST['order_id'];
        $order_status['status_id'] = $_POST['status_id'];
        status_update($order_status);
        //insert order history
        $result=order_history_add($order_status);

    }
?>
<?php $page_title = 'Orders'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Orders</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $current_status; ?></li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-newspaper me-1"></i>
                                        <?php echo $current_status; ?> Detail 
                                      
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Order</th>
                                                        <th>Customer Name</th>
                                                        <th>Order Date</th>
                                                        <th>View Details</th>
                                                        

                                                    </tr>
                                                </thead>
                                                <?php   $orders = order_list($status_id);  $sn = 1;?>
                                                <tbody>
                                                  <?php while($order = mysqli_fetch_assoc($orders)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo $order['order_no']; ?></td>
                                                      <td><?php echo $order['customer_name']; ?></td>
                                                      <td><?php echo datetime_to_text($order['order_date']); ?></td>
                                                      <td>
                                                        <?php require("btn-order-status.php"); ?>
                                                    </td>
                                                      

                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($orders); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>