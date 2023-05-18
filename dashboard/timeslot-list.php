<?php  require_once("includes/initialize.php"); 
$doctor_id=$_SESSION['admin_id'];
?>

<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(timeslot_delete($id)){
        $_SESSION['message'] = 'Timeslot Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Timeslot List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Timeslot</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Timeslot List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-bimobject"></i>
                                        Timeslot Detail 
                                        <a href="timeslot.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-bimobject"></i> Add New Timeslot</a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                          <div class="col-xl-12">
                                            <table class="table table-bordered table-striped table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>SN</th>
                                                        
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Doctor_id</th>

                                                        <th>Status</th>
                                                        
                                                        <th>Change Button</th>
                                                        <th><a href="change-statusall_timeslot.php" class="btn btn-success">Change Status to Available</a></th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $timeslot_set = timeslot_select_all($doctor_id);  $sn = 1;?>
                                                <tbody>
                                                  <?php while($timeslot = mysqli_fetch_assoc($timeslot_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                     
                                                      <td><?php echo h($timeslot['from_time']) ?></td>
                                                      <td><?php echo h($timeslot['to_time']) ?></td>
                                                      <td><?php echo h($timeslot['doctor_id']) ?></td>
                                                      <td><?php echo $timeslot['status']=="0"?"Available":"Not Available"; ?></td>
                                                      <td><a href="change-status.php?id=<?php echo $timeslot['id']; ?>">Change Status</a></td>
                                                      <td>Change to Available timeslot</td>
                                                      <td>
                                                        <form action="timeslot-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $timeslot['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $timeslot['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i></button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            <?php mysqli_free_result($timeslot_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>