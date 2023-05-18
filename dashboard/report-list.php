<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(report_delete($id)){
        $_SESSION['message'] = 'Report Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Report List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Report</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Report List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-product-hunt"></i>
                                        Report Detail 
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <div class="table-responsive">
                                            <?php $reports = report_select_all(); ?>
                                            <table id="dataTable" class="table table-bordered table-striped table-hover">
                                           
                                            <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Order No.</th>
                                                        <th>Customer id</th>
                                                        <th>Order Date</th>
                                                        <!-- <th>Filename</th> -->
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php $sn = 1;?>
                                                <tbody>
                                                <?php while($report=mysqli_fetch_assoc($reports)){?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo $report['order_no'];?></td>
                                                      <td><?php echo $report['customer_id'];?></td>
                                                      <td><?php echo $report['order_date'];?></td>          
                                                      <td>
                                                        <form action="report-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $report['id'] ?>" >
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $report['id'] ?>" >
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                           <?php }?>
                                                </tbody>
                                            </table>
                                            </div>
                                           
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>