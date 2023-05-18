<?php  require_once("includes/initialize.php"); ?>

<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(speciality_delete($id)){
        $_SESSION['message'] = 'speciality Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All speciality List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">speciality</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">speciality List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-product-hunt"></i>
                                    speciality Detail 
                                        <a href="speciality-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-product-hunt"></i> Add New speciality</a>
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
                                                        <th>File Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $speciality_set = speciality_select_all();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($speciality = mysqli_fetch_assoc($speciality_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($speciality['name']) ?></td>
                                                      <td><img src="uploads/speciality/<?php echo h($speciality['filename']);?>" style="width:100px; height:100px;"  alt=""></td>

                                                      <td>
                                                        <form action="speciality-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $speciality['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $speciality['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                            <?php mysqli_free_result($speciality_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>