<?php  require_once("includes/initialize.php"); ?>
<?php  
    if(isset($_POST['deletesubmit'])){
      $id = $_POST['id'];
      if(doctor_delete($id)){
        $_SESSION['message'] = 'Doctor Deleted.';
        $_SESSION['alert'] = 'warning';
      }
    }
?>
<?php $page_title = 'All Product List'; ?>
<?php require_once("header.php"); ?>

                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Doctor</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Doctor List</li>
                        </ol>
                         <?php echo display_errors($errors); ?>
                         <?php echo display_session_message(); ?>
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card mb-4">
                                    <div class="card-header">
                                    <i class="fab fa-product-hunt"></i>
                                    Doctor Detail 
                                        <a href="doctor-add.php" class="btn btn-sm btn-primary float-end"><i class="fab fa-product-hunt"></i> Add New Doctor</a>
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
                                                        <th>speciality Name</th>
                                                        <th>Pay Price</th>
                                                        <th>Education</th>
                                                       <th>Field of Expertise</th>
                                                        <th>Experience</th>
                                                        <th>Awards</th>
                                                        <th>File Name</th>
                                                        <th>Edit</th>
                                                        <th>Delete</th>

                                                    </tr>
                                                </thead>
                                                <?php   $doctor_set = doctor_select_all();  $sn = 1;?>
                                                <tbody>
                                                  <?php while($doctor = mysqli_fetch_assoc($doctor_set)) { ?>
                                                    <tr>
                                                      <td><?php echo $sn++; ?></td>
                                                      <td><?php echo h($doctor['name']) ?></td>
                                                      <td><?php echo h($doctor['speciality_name']) ?></td>
                                                      <td><?php echo h($doctor['pay_price']) ?></td>
                                                      <td><?php echo h($doctor['education']) ?></td>
                                                      <td><?php echo h($doctor['field_of_expertise']);?></td>
                                                      <td><?php echo h($doctor['experience']) ?></td>
                                                      <td><?php echo h($doctor['awards']) ?></td>
                                                      <td><img src="uploads/doctors/<?php echo h($doctor['filename']);?>" style="width:100px; height:100px;"  alt=""></td>

                                                      <td>
                                                        <form action="doctor-add.php" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $doctor['id'] ?>">
                                                          <button type="submit" name="updatesubmit" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></button>
                                                        </form>
                                                      </td>
                                                      <td>
                                                        <form action="" method="post">
                                                          <input type="hidden" name="id" value="<?php echo $doctor['id'] ?>">
                                                          <button type="submit" name="deletesubmit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');"><i class="fas fa-trash"></i> </button>
                                                        </form>
                                                      </td>
                                                      
                                                    </tr>
                                                  <?php } ?>
                                                </tbody>
                                            </table>
                                            </div>
                                            <?php mysqli_free_result($doctor_set); ?>
                                          </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                             
                        </div>
                        
                    </div>
                </main>
               <?php require_once("footer.php"); ?>