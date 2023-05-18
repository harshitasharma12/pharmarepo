<?php require_once("includes/initialize.php"); ?>
<?php $page_title = 'Appoinment List'; ?>
<?php $customer_name = get_customer_name(); ?>
<?php $doctor_id = $_SESSION['admin_id']; ?>
<?php
if (is_admin()) {
  $doctor_id = false;
} else {
  $doctor_id = $_SESSION['admin_id'];
}
?>
<?php require_once("header.php"); ?>

<main>
  <div class="container-fluid px-4">
    <h1 class="mt-4">Appoinment</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Appoinment List</li>
    </ol>
    <?php echo display_errors($errors); ?>
    <?php echo display_session_message(); ?>
    <div class="row">
      <div class="col-xl-12">
        <div class="card mb-4">
          <div class="card-header">
            <i class="fab fa-bimobject"></i>
            Appoinment Detail

          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-xl-12">
                <table class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>SN</th>
                      <th>Doctor Name</th>
                      <th>Customer Name</th>
                      <th>Appoinment Slot From</th>
                      <th>Appoinment Slot to</th>
                      <th>Remarks</th>
                      <th>Google meet link</th>

                      <th>Action</th>


                    </tr>
                  </thead>
                  <?php $result_set = appoinment_select_all($doctor_id);
                  $sn = 1; ?>
                  <tbody>
                    <?php while ($result = mysqli_fetch_assoc($result_set)) { ?>
                      <tr>
                        <td><?php echo $sn++; ?></td>

                        <th><?php echo $result['name']; ?></th>
                        <td><?php echo $customer_name ?></td>
                        <td><?php echo $result['from_time']; ?></td>
                        <td><?php echo $result['to_time']; ?></td>

                        <td>
                          <?php if ($result['remarks'] == NULL) {
                            echo 'After Consulting Doctor It Will be Added Soon
                                                          ';
                          } else {
                            echo $result['remarks'];
                          } ?>
                        </td>
                        <td>
                          <?php if ($result['google_id'] == NULL) {
                            echo 'Will be updated soon';
                          } else {
                            echo $result['google_id'];
                          } ?>
                        </td>


                        <td>
                          <?php if (is_admin()) { ?>

                            <div class="dropdown">
                              <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Action
                              </button>
                              <ul class="dropdown-menu">
                                <li><a class="dropdown-item text-primary" href="googlemeet-add.php?id=<?php echo $result['appoinment_id']; ?>"><i class="fas fa-edit"></i>&nbsp; &nbsp;Update</a></li>
                                <li><a class="dropdown-item text-danger" href="appoinment_delete.php?id=<?php echo $result['appoinment_id'];?>"><i class="fas fa-trash"></i>&nbsp; &nbsp; Delete</a></li>
                                
                              </ul>
                            </div>

                            

                          <?php } else { ?>
                            <a href="remarks-add.php?id=<?php echo $result['appoinment_id']; ?>"><i class="fas fa-edit"></i></a>
                          <?php } ?>
                        </td>





                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
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