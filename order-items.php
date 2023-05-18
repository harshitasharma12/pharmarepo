<?php
$order_product = order_product_by_orderno_all($order['order_no']);
while ($row = mysqli_fetch_assoc($order_product)) {
?>
    <?php
    if ($row['product_type'] == "medicines") {
        $dir = "files";
        $product = product_select_by_id($row['product_id']);
    } else if ($row['product_type'] == "labtest") {
        $dir = "labtest";
        $product = labtest_select_by_id($row['product_id']);
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-4 col-sm-4 col-md-4">
                <img src="dashboard/uploads/<?php echo $dir; ?>/<?php echo $product['filename']; ?>" style="height:100px;">
                
            </div>
            <div class="col-8 col-sm-8 col-md-8 mt-2">
                <div class="row">
                    <span><?php echo $row['product_name']; ?></span><br>
                </div>
                <div class="row">
                    <div class="col-6 col-sm-12 col-md-6">
                        <span>Quantity:<?php echo $row['quantity']; ?></span>
                    </div>
                    <div class="col-6 col-sm-6 col-md-6">
                        <span>Price:<?php echo $row['price']; ?></span>
                    </div>
                </div>
                <?php if ($row['product_type'] == "labtest") { ?>
                    <div class="row">
                        <span>Sample Collection Date: <?php echo datetime_to_text($order['sample_date']); ?></span>
                    </div>
                <?php } ?>


            </div>
        </div>
     <?php  if($row['status']=="3"){ ?>
        <div class="row">
            <div class="col-md-12 text-center">
                <span class="badge text-bg-danger"><?php echo "Product Cancelled due to ".$row['remarks']; ?></span>
            </div>
        </div>
                
     <?php       }
        ?>
                 
        <hr>
    </div>
<?php } ?>