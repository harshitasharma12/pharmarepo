<?php require_once("header.php");?>
<?php 
        $customer_id = 0;
        if(is_logged_in_customer()){
            $customer_id = get_customer_id();
        }
?>
<?php $reports = report_by_customer_id($customer_id); ?>
<?php if(mysqli_num_rows($reports)>0){?>
<div class="container">
    <div class="row">
    <div class="col-md-12 mt-3">
    <table class="table table-bordered">
            <tr>
                <th>SN</th>
                <th>Order Number</th>
                <th>Test Name</th>
                <th>Date</th>
                <th>Report</th>
            </tr>
            <?php $sn=1; while($report=mysqli_fetch_assoc($reports)){?>
                <?php if ($report['filename']==true){?>
                   <tr>
                    <td><?php echo $sn++;?></td>
                    <td><?php echo $report['order_no']?></td>
                    <td><?php echo $report['product_name']?></td>
                    <td><?php echo $report['order_date']?></td>
                    <td>  <a  href="dashboard/uploads/reports/<?php echo $report['filename']; ?>" class="btn btn-primary">Download</a></td>
                   </tr> 
              <?php }?>
            <?php }?>    
        </table>
    </div>
        
    </div>
</div>
<?php } else {?>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="alert alert-danger">
                    no test report available
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php require_once("footer.php");?>