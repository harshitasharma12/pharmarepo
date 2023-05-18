<?php
$customer_id = get_customer_id();
$customer_name = get_customer_name();
$customer_contact = get_customer_contact();
?>
<div class="row">
  <div class="col-md-6 col-12">
    <div class="card mt-3" style="box-shadow:3px 2px 5px grey;">
      <div class="card-body">
        <a href="details_doctor.php?id=<?php echo $row_set['id']; ?>" style="text-decoration:none;color:black;">
          <div class="row">
            <div class="col-4 col-4">
              <img src="dashboard/uploads/doctors/<?php echo $row_set['filename']; ?>" class="card-img-top mx-auto d-block mt-1 img-fluid" alt="...">
            </div>
            <div class="col-8 col-8">
              <div class="row">
                <span style="font-size:17px;"><?php echo $row_set['name']; ?></span>
              </div>
              <div class="row">
                <span style="font-size:14px;color:#0087ba;"><?php echo $row_set['working_as']; ?></span>
              </div>
              <hr style="margin:3px;padding:0px;">
              <div class="row">
                <span style="font-size:13px;color:#0087ba;font-weight:bolder;"><?php echo $row_set['education']; ?></span>
              </div>

            </div>

          </div>

        </a>
        <div class="row">
          <span class="text-center">You Pay &#8377; <?php echo $row_set['pay_price']; ?></span>
        </div>
        <div class="col-md-12 col-sm-12 col-12 d-flex justify-content-center align-items-center">
          <a href="appoinment_select.php?id=<?php echo $row_set['id'];?>" class="btn btn-success px-5">
            Book Video Consult
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-12">
      <div class="card mt-3" style="box-shadow:3px 2px 5px grey;">
        <div class="card-body ">
          <div class="row">
            <?php
            $timeslots = timeslot_by_doctorid($row_set['id']);
            while ($timeslot = mysqli_fetch_assoc($timeslots)) { ?>
              <div class="col-md-6 col-6">

                <?php if ($timeslot['status'] == "0") { ?>
                  <span><?php echo $timeslot['from_time']; ?>- <?php echo $timeslot['to_time']; ?></span>
                <?php } else { ?>
                  <?php echo "Slot not available<br/>"; ?>
                <?php } ?>

              </div>
            <?php  } ?>
          </div>
        </div>
      </div>
    </div>
  </div>
