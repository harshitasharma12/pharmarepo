<?php require("header.php");
if (isset($_GET['id'])) {
    $speciality_id = $_GET['id'];
    $result=speciality_select_by_id($speciality_id);
}
?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-12">
            <div class="card mt-3" style="box-shadow:3px 2px 5px grey;">
                <div class="card-body">
                <label for="floatingInput">Best <?php echo $result['name'];?> Doctors</label>
                <hr>
                <?php
                   
                    $row = doctor_by_speciality($speciality_id);
                    if(mysqli_num_rows($row)>0){
                    while ($row_set = mysqli_fetch_assoc($row)) {
                        require("list_of_doctors_speciality.php");
                    } 
                }else{?>
                    <span style="font-size:18px;color:#42855b;">Doctors of this fields are not Added yet</span>

               <?php }?>
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
    </div>
</div>
<?php require("footer.php"); ?>