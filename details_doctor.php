<?php require_once("header.php");
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
$details = doctor_select_all($id); ?>
<div class="container">
    <div class="row">
        <?php while ($detail = mysqli_fetch_assoc($details)) { ?>
            <div class="col-md-8 col-sm-8">
                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-sm-4">
                                <img src="dashboard/uploads/doctors/<?php echo $detail['filename']; ?>" class="card-img-top">
                                <!-- <button type="button" class="btn btn-success mt-4" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Book Vedio Consult
                                </button> -->
                            </div>
                            <div class="col-md-8 col-sm-8">
                                <div class="row">
                                    <span class="fs-5 text-center mb-1"><?php echo $detail['name']; ?></span>
                                    <hr class="text-success" style="padding:0px;margin:2px;">
                                    <p class="fs-6 text-center mt-1 mb-1">Department: <?php echo $detail['working_as']; ?></p>
                                    <hr class="text-success" style="padding:0px;margin:0px;">
                                    <span class="fs-6 mt-2 mb-1"><i class="fas fa-graduation-cap" style="font-size:23px"></i>&nbsp;Education<?php echo $detail['education']; ?></span>
                                    <span class="fs-6 mt-2 mb-1" style="font-size:23px"></i>&nbsp;Experience<?php echo $detail['education']; ?></span>
                                </div>


                            </div>
                        </div>
                        <div class="row">
                        <span class="fs-6 mt-3 mb-1">Field of Expertise<?php echo $detail['field_of_expertise']; ?></span>  
                        <span class="fs-6 mt-3 mb-1"><i class="fas fa-award"></i>&nbsp; Awards And Achievements<?php echo $detail['awards']; ?></span>
                    </div>

                        <div class="row mt-3">
                            <span><i class="fas fa-map-marker-alt"></i> Clinic Address</span>
                            <hr class="text-success" style="padding:0px;margin:2px;">
                            <span><?php echo $detail['currently_working_in'];?></span>
                            <span class="mt-4"><i class="fas fa-calendar-week"></i> Timings(Slots are Changed on Daily Basis)</span>
                            <hr class="text-success" style="padding:0px;margin:2px;">
                            <?php  $timeslots=timeslot_by_doctorid($id);
                            while($timeslot=mysqli_fetch_assoc($timeslots)){?>
                            <div class="col-md-4 col-sm-4">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <?php echo $timeslot['from_time'];?>-<?php echo $timeslot['to_time'];?>
                                    </div>
                                </div>
                            </div>

                            <?php }?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 col-sm-4">
            <div class="card mt-4 ">
                <div class="card mt-2 " style="border:0 ">
                    <h6 class="mb-0 px-3">How can I consult With <?php echo $detail['name'];?>:</h6>
                     
                </div>
                <div class="row mt-3">
                    <div class="col-md-6 col-sm-6 mx-auto">  
                <div class="card">
                    <div class="card-body text-center">
                       <span >Video Consult </span><br>
                       <span class="fs-5 mb-1">&#8377; <?php echo $detail['pay_price'];?></span>
                    </div>
                </div>
                </div>
                </div>
                
                
                
                <div class="card-body">
               
                    <p><i class="fas fa-user-md"></i>&nbsp;&nbsp;Choose the Doctor</p>
                    <p><i class="fas fa-calendar-week"></i>&nbsp;&nbsp;Book a slot</p>
                    <p><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Make payment</p>
                    <p><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Be present in the consult room on google meet provided by the doctor</p>

                </div>
            </div>
        </div>
        <?php } ?>
       
    </div>


</div>




<?php require_once("footer.php"); ?>