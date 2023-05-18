<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(brand_delete($id)){
        $_SESSION['message'] = 'Brand Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Brand List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Brand</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Brand List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-bimobject"></i>
                                        Brand Detail 
                                        <a href="brand-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-bimobject"></i> Add New Brand</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $brand_set = brand_select_all();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($brand = mysqli_fetch_assoc($brand_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($brand['name']) ?></td>
                                                      <td>
                                                        <form action="brand-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $brand['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $brand['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($brand_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>