<?php  require_once("includes/initialize.php"); ?>
<?php  
  if(!is_admin()){
    redirect_to("401.html");
  }
?>
<?php $page_title = 'All Sub Category List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4"> Sub Category</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">All <Sub></Sub>Sub Category</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fa fa-check-circle me-1"></i>
                                       Sub Category Details 
                                        <a href="sub-category-add.php" class="btn btn-sm btn-primary float-end"><i class="fa fa-check-circle"></i> Add New Category</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Sub Category Name</th>
                                                        <th>Category Id</th>
                                                        <th>Delete</th>
                                                        <th>Update</th>
                                                    </tr>
                                                </thead>
                                                <?php   
                                                $result = sub_category_select_all();  
                                                $sn = 1;?>
                                                <tbody>
                                                  <?php while($sub_category = mysqli_fetch_assoc($result)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo ($sub_category['sub_category_name']) ?></td>
                                                      <td><?php echo ($sub_category['category_name']) ?></td>
                                                      <td><a href="sub-category-delete.php?id=<?php echo $sub_category['id'];?>" class="btn btn-danger">Delete</a></td>
                                                      <td><a href="sub-category-update-form.php?id=<?php echo $sub_category['id'];?>" class="btn btn-success">Update</a></td>
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($result); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>