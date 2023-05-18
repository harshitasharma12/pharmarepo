<?php require_once("includes/initialize.php");

?>
<?php
require_login();
?>
<?php
if (is_get_request()) {
  $order_no = $_GET['order_no'];
  $order = order_by_orderno($order_no);
}

if (isset($_POST['submit'])) {
  $order_product = $_POST;
  update_status_order_product($order_product);
  redirect_to("order-list.php?id=1");
} else if (isset($_POST['btnChangeStatus'])) {
  $order = $_POST;
  
    status_update($order);
    $order_history = [];
    $order_history = $order;
    $order_history_result = order_history_add($order_history); 
  redirect_to("order-list.php?id=" . $_POST['status_id']);

}

?>
<?php $page_title = 'Ordered Product Details'; ?>
<?php require_once("header.php"); ?>

<main>
  <div class="container-fluid px-4">
    <div class="row">
      <div class="col-5">
        <h1 class="mt-4">Product Details</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Product Details</li>
        </ol>
      </div>
      <div class="col-7 text-end mt-2">
        <table id="dataTable1" class="table table-bordered table-striped table-hover">
          <thead>
            <tr>
              <th colspan="2" style="text-align:center;">Order Details</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>Order Number</th>
              <td><?php echo $order['order_no']; ?></td>
            </tr>
            <tr>
              <th>Customer Name</th>
              <td><?php echo $order['customer_name']; ?></td>
            </tr>
            <tr>
              <th>Address</th>
              <td><?php echo $order['address']; ?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <?php echo display_errors($errors); ?>
    <?php echo display_session_message(); ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fab fa-product-hunt"></i>
            Product Details
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-12">
                <div class="table-responsive">
                  <table id="dataTable1" class="table table-bordered table-striped table-hover">
                    <thead>
                      <tr>
                        <th>SN</th>
                        <th>Product Name</th>
                        <th>Cancel</th>


                      </tr>
                    </thead>
                    <?php $result_set = order_product_by_orderno($order_no);
                    $sn = 1; ?>
                    <tbody>
                      <?php while ($result = mysqli_fetch_assoc($result_set)) { ?>
                        <tr>
                          <td><?php echo $sn++; ?></td>
                          <td><?php echo $result['product_name']; ?></td>
                          <td>
                            <?php
                            if ($result['product_type'] == "medicines") {

                              if (is_pre_required($result['product_id'])) { ?>
                                <?php
                                if ($result['status'] == "3") {
                                  echo "Item Cancelled due to " . $result['remarks'];
                                } else { ?>
                                  <form method="post" action="">
                                    <input type="hidden" name="order_product_id" value="<?php echo $result['id']; ?>">
                                    <input type="text" name="reason">
                                    <button name="submit" class="btn btn-danger">Submit</button>
                                    <a href="../uploads/prescription/<?php echo $result['filename']; ?>" target="_blank" class="btn btn-success">View Prescription</a>
                                  </form>
                                <?php } ?>
                            <?php     } else {

                                echo "No Prescription required";
                              }
                            }
                            ?>

                          </td>
                        <?php } ?>

                        </tr>

                    </tbody>
                  </table>
                  
                  
                    <form method="post" action="">
                      <input type="hidden" name="order_id" value="<?php echo $order['id']; ?>">
                      <input type="hidden" name="status_id" value="2">
                      <input type="hidden" name="order_no" value="<?php echo $order['order_no']; ?>">
                      <button name="btnChangeStatus" class="btn btn-success">Confirm Order</button>
                    </form>
                 


                </div>
                <?php mysqli_free_result($result_set); ?>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>

  </div>
</main>
<?php require_once("footer.php"); ?>