<?php require_once("header.php");?>
<?php
if(isset($_GET['id']))
{
    $doctor_id=$_GET['id'];
}
$doctor_data=doctor_select_by_id($doctor_id);
$customer_id=get_customer_id();
$customer_name=get_customer_name();
$customer_contact=get_customer_contact();
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-6 mx-auto">
            <div class="card" style="box-shadow:3px 2px 10px grey">
                <div class="card-header">
                <h5 class="text-center">Appointment Form for <?php echo $doctor_data['name'];?></h5>
                </div>
                <div class="card-body">
                <form action="appointment-exec.php" method="POST">
                  <input type="hidden" name="doctor_id" id="doctor_id" value="<?php echo $doctor_id; ?>">
                  <input type="hidden" name="customer_id" id="customer_id" value="<?php echo $customer_id; ?>">
                  <div class="form-floating mb-3 mt-2">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $customer_name; ?>">
                    <label for="floatingInput">Name</label>
                  </div>

                  <div class="form-floating mb-3 mt-4">
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo $customer_contact; ?>">
                    <label for="floatingInput">Contact</label>
                  </div>

                  <div class="mb-3">
                    <label for="floatingSelect">Appointment List</label>
                    <select name="date" class="form-select" id="date">
                      <option value="0">--Select--</option>
                      <?php
                      $timeslots = timeslot_by_doctorid($doctor_id);
                      while ($timeslot = mysqli_fetch_assoc($timeslots)) { ?>
                        <?php if ($timeslot['status'] == "0") { ?>
                          <option value="<?php echo $timeslot['id']; ?>"><?php echo $timeslot['from_time']; ?>-<?php echo $timeslot['to_time']; ?></option>
                        <?php } ?>
                      <?php } ?>
                    </select>
                  </div>



                 
                    <?php if (isset($_SESSION['customer_id'])) { ?>
                      <button name="submit" class="btn btn-outline-success">Submit</button>
                    <?php } else { ?>
                      <a href="login.php" class="btn btn-outline-success">Submit</a>
                    <?php } ?>
                
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

                

            
               
              
     


<?php require_once("footer.php");?>