<?php  require_once("includes/initialize.php"); ?>
<?php  
  if(!is_admin()){
    redirect_to("401.html");
  }
?>
<?php  
  $role = array('2' => "Admin", '3' => "Writer");
?>
<?php  
    if(isset($_POST['btnConfirm'])){
      $user_id = $_POST['user_id'];
      if(confirm_user_by_id($user_id)){
        $_SESSION['message'] = 'User status changed successfully.';
        $_SESSION['alert'] = 'warning';
      }  

    }
?>
<?php $page_title = 'All Users List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Users</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">All Users</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <i class="fas fa-users me-1"></i>
                                        Users Details 
                                        <a href="user-add.php" class="btn btn-sm btn-primary float-end"><i class="fas fa-user"></i> Add New User</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table id="datatablesSimple">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        <th>User ID</th>
                                                        <th>Password</th>
                                                        <th>Is Active</th>
                                                        <th>Change</th>

                                                    </tr>
                                                </thead>
                                                <?php   $users = find_all_users();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($user = mysqli_fetch_assoc($users)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($user['type']) ?></td>
                                                      <td><?php echo h($user['password']) ?></td>
                                                      <td><?php if(find_confirm_status($user['id'])){ echo "<span class=\"badge bg-primary\">Yes</span>"; } else { echo "<span class=\"badge bg-secondary\">No</span>"; } ?></td>  
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="user_id" value="<?php echo $user['id'] ?>">
                                                          <button type="submit" name="btnConfirm" class="btn btn-outline-primary btn-sm">Change</button>
                                                        </form>
                                                      </td>
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($users); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>