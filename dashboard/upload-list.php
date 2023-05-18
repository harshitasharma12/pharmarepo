<?php  require_once("includes/initialize.php"); ?>
<?php  
  is_logged_in();
?>
<?php  
  $role = array('2' => "Admin", '3' => "Writer");
?>
<?php  
    if(isset($_POST['btnDelete'])){
      $id = $_POST['id'];
      if(delete_upload($id)){
        $_SESSION['message'] = 'Upload Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Users List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Upload</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Upload List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-newspaper me-1"></i>
                                        Upload Detail 
                                        <a href="upload-add.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-newspaper"></i> Add New Upload</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                        <th>Created On</th>
                                                        <th>View File</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php if(is_office_user()){?>
                                                <?php   $uploads = find_all_upload($_SESSION['admin_id']);  $sn = 1;?>
                                                <?php } else if(is_admin()){ ?>
                                                   <?php   $uploads = find_all_upload();  $sn = 1;?>
                                                <?php } ?>  
                                               
                                                <tbody>
                                                  <?php while($upload = mysqli_fetch_assoc($uploads)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($upload['title']) ?></td>
                                                      <td><?php echo h($upload['filename']) ?></td>
                                                      <td><?php echo datetime_to_text($upload['upload_date']); ?></td>
                                                      <td><a class="btn btn-outline-primary btn-sm" href="uploads/files/<?php echo $upload['filename']; ?>" download><i class="fas fa-download"></i></a></td>
                                                      <!-- <td>
                                                        <form action="upload-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $upload['id'] ?>">
                                                          <button type="submit" name="btnUpdate" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td> -->
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $upload['id'] ?>">
                                                          <button type="submit" name="btnDelete" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($uploads); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>