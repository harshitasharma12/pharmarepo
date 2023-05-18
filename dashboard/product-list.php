<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(product_delete($id)){
        $_SESSION['message'] = 'product Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Product List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Product</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Product List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-product-hunt"></i>
                                        Product Detail 
                                        <a href="product-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-product-hunt"></i> Add New Product</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <div class="table-responsive">
                                            <table id="dataTable" class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Name</th>
                                                        <th>Medicine type</th>
                                                        <th>Price</th>
                                                        <th>Expire Date</th>
                                                       
                                                        <th>Prescription</th>
                                                        <th>Category Name</th>
                                                        <th>Sub Category Name</th>
                                                        <th>Brand Name </th>
                                                        <th>Discount</th>
                                                        <th>File Name</th>
                                                        <th>Product availablity</th>
                                                        <th>Change Status</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $product_set = product_select_all();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($product = mysqli_fetch_assoc($product_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($product['name']) ?></td>
                                                      <td><?php echo h($product['medicine_type']) ?></td>
                                                      <td><?php echo h($product['price']) ?></td>
                                                      <td><?php echo h($product['expire_date']) ?></td>
                                                     
                                                     
                                                      <td><?php echo h($product['prescription']) ?></td>
                                                      <td><?php echo h($product['category_name']) ?></td>
                                                      <td><?php echo h($product['sub_category_name']) ?></td>
                                                      <td><?php echo h($product['brand_name']) ?></td>
                                                      <td><?php echo h($product['discount']) ?></td>
                                                      <td><?php echo $product['available']=="0"?"Available":" Not Available"; ?></td>
                                                      <td><a href="availablity_product.php?id=<?php echo $product['id']; ?>">Change Status</a></td>
                                                      <td><img src="uploads/files/<?php echo h($product['filename']);?>" style="width:100px; height:100px;"  alt=""></td>
                                                      
                                                      <td>
                                                        <form action="product-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $product['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                            <?php mysqli_free_result($product_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>