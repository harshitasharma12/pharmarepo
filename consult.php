<?php require("header.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card mt-3 " style="box-shadow:3px 2px 5px grey;">
                <div class="card mt-2 " style="border:0 ">
                    <h5 class="mb-0 px-3">Online Doctors Consultation</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                    <form class=" d-flex justify-content-start md-form form-sm  ">
                        <i class="fas fa-search mt-2" aria-hidden="true"></i>
                        <input class="form-control form-control-sm ml-3 w-75 px-3 mb-4" type="text" placeholder="Search doctors or specialities" aria-label="Search" style="border-radius:0;border:0;border-bottom:1px solid black;">
                    </form>
                    <label for="floatingInput">Specialities</label>
                    <hr>
                    <?php
                    $no_of_col = 6;
                    $result_set = speciality_select_all();
                    while ($result = mysqli_fetch_assoc($result_set)) {
                        require("speciality_in.php");
                    } ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12">
            <div class="card mt-3 " style="box-shadow:3px 2px 5px grey;">
                <div class="card mt-2 " style="border:0 ">
                    <h6 class="mb-0 px-3">How To Consult Doctor Online</h6>
                     
                </div>
                
                
                <div class="card-body">
               
                    <p><i class="fas fa-user-md"></i>&nbsp;&nbsp;Choose the Doctor</p>
                    <p><i class="fas fa-calendar-week"></i>&nbsp;&nbsp;Book a slot</p>
                    <p><i class="fas fa-money-check-alt"></i>&nbsp;&nbsp;Make payment</p>
                    <p><i class="fas fa-mobile-alt"></i>&nbsp;&nbsp;Be present in the consult room on google meet provided by the doctor</p>

                </div>
            </div>
        </div>
    </div>
    <div>

        <?php require("footer.php"); ?>