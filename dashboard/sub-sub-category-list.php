<?php  require_once("includes/initialize.php"); ?>
<?php  
  require_login();
?>
<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(sub_sub_category_delete($id)){
        $_SESSION['message'] = 'Sub Sub Category Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Sub Sub Category List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Sub Sub Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Sub Sub Category List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-bimobject"></i>
                                    Sub Sub Category Detail 
                                        <a href="sub-sub-category-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-bimobject"></i> Add New Sub Sub Category</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Name</th>
                                                        <th>Sub Category Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $sub_sub_category_set = sub_sub_category_select_all();  
                                                $sn = 1;?>
                                                <tbody>
                                                  <?php while($sub_sub_category = mysqli_fetch_assoc($sub_sub_category_set)) {?>
                                                    
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($sub_sub_category['name']); ?></td>
                                                      <td><?php echo h($sub_sub_category['sub_category_name']) ?></td>
                                                      <td>
                                                        <form action="sub-sub-category-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $sub_sub_category['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $sub_sub_category['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($sub_sub_category_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>