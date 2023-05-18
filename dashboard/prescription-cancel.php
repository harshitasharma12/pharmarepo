<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>

<?php $page_title = 'All Prescription List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Prescription</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Prescription List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-product-hunt"></i>
                                        Prescription Detail 
                                        <a href="product-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-product-hunt"></i> Add New Prescription</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Customer Name</th>
                                                        <th>Product Name</th>
                                                        <th>Prescription</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $result_set = order_product_select_all();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($result = mysqli_fetch_assoc($result_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo get_customer_name();?></td>
                                                      <td><?php echo $result['product_name'];?></td>
                                                      <?php if($result['filename']==true){?>
                                                      <td><a  href="uploads/prescription/<?php echo $result['filename']; ?>" class="btn btn-primary">Download</a></td>
                                                      <?php }?>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
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