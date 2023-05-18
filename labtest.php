<?php require("header.php"); ?>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-12 mt-3">
            <!-- <div class="card mt-3 ">
                <div class="card-body"> -->
                    <form class=" d-flex justify-content-start md-form form-sm px-5 ">
                        <i class="fas fa-search mt-2" aria-hidden="true"></i>
                        <input class="form-control form-control-sm ml-3 w-75 px-3 mb-4" type="text" placeholder="Search test" aria-label="Search" style="border-radius:0;border:0;border-bottom:1px solid black;">
                    </form>
                <!-- </div>
            </div> -->

        </div>
    </div>
    <div class="row products">
            <?php
            
            $result_set=labtest_select_all();
            while($result=mysqli_fetch_assoc($result_set)){
                 
                require("labtest-list.php");
              
            }
            ?>
    </div>
        <!-- </div>
    </div> -->
</div>
<?php require("footer.php");?>